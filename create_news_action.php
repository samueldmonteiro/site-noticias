
<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Models\Auth;
use Src\Utils\Filter;
use Src\Utils\Redirect;
use Src\Utils\Message;
use Src\Utils\Validate;
use Src\Dao\NewsCategoryDaoMysql;
use Src\Dao\NewsDaoMysql;
use Src\Models\News;
use Src\Upload\ImageUpload;

$auth = new Auth($pdo, $base);
$validate = new Validate($pdo);

$userInfo = $auth->checkAuthentication(true);
if(!$auth->isAdmin($userInfo)){
    Redirect::local("index.php");
}

$newsTitle = Filter::input($_POST['news-title']);
$newsSubject = Filter::input($_POST['news-subject']);
$newsCategory = Filter::input($_POST['news-category']);
$newsBody = Filter::newsBody($_POST['news-body']);

if(isset($_FILES['news-cover'])){
    $newsCover = $_FILES['news-cover'];
}

if($newsTitle && $newsSubject && $newsBody && !empty($newsCover['name'])){

    if(!$validate->dataSizeLimit([$newsTitle, $newsSubject],100)){
        Message::returnByAjax("error", "Título ou Assunto Prescisam ter Menos de 100 caracteres!");
    }

    if(!$validate->newsCategoryExists($newsCategory)){
        Message::returnByAjax("error", "");
    }

    $newsCategoryDao = new NewsCategoryDaoMysql($pdo);
    $categoryId = $newsCategoryDao->findByName($newsCategory)->id;

    $localCoverUpload = "./media/news/";
    $imageUpload = new ImageUpload($newsCover, 900, 600, $localCoverUpload);

    if($imageUpload->getAlert()){
        Message::returnByAjax("error", $imageUpload->getAlert());
    }


    $news = new News();
    $news->id_user = $userInfo->id;
    $news->id_category = $categoryId;
    $news->created_at = date("Y-m-d H:i:s");
    $news->title = $newsTitle;
    $news->subject = $newsSubject;
    $news->body = $newsBody;
    $news->cover = $imageUpload->imageNameFile;
    
    $newsDao = new NewsDaoMysql($pdo);
    $newsDao->insert($news);
    Message::returnByAjax("success", "Notícia Publicada com Sucesso!");
    
}else{
    Message::returnByAjax("error", "Preencha Todos os Campos!");
}

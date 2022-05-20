<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Dao\NewsCategoryDaoMysql;
use Src\Dao\NewsDaoMysql;
use Src\Models\Auth;
use Src\Upload\ImageUpload;
use Src\Utils\Filter;
use Src\Utils\Message;
use Src\Utils\Validate;

$auth = new Auth($pdo, $base);
$newsDao = new NewsDaoMysql($pdo);

$userInfo = $auth->checkAuthentication(true);
$auth->onlyAdmin($userInfo);

$newsTitle = Filter::input($_POST['news-title']);
$newsCategory = Filter::input($_POST['news-category']);
$newsSubject = Filter::input($_POST['news-subject']);
$newsBody = Filter::newsBody($_POST['news_body_update']);
$newsId = Filter::input($_POST['news-id']);
$newsCover = $_FILES['news-cover'];

$currentNews = $newsDao->findById($newsId);

if($currentNews && $newsTitle && $newsCategory && $newsSubject && $newsBody){

    $validate = new Validate($pdo);
    $newsCategoryDao = new NewsCategoryDaoMysql($pdo);

    if(!$validate->dataSizeLimit([$newsTitle, $newsSubject], 100)){
        Message::setMessageInSession("error", "O Título e o Assunto devem conter menos de 100 Caracteres");
    }

    if(!$newsCategoryDao->findById($newsCategory)){
        Message::setMessageInSession("error", "Desculpe! Categoria não Encontrada.");
    }

    if(!empty($newsCover['name'])){
       
        $localUpload = "./media/news/";

        $imageUpload = new ImageUpload($newsCover,900,600, $localUpload);
        if($imageUpload->getAlert()){
            Message::setMessageInSession("error", $imageUpload->getAlert());
        }

        if(!empty($currentNews->cover)){
            unlink($localUpload . $currentNews->cover);
        }

        $currentNews->cover = $imageUpload->imageNameFile;
    }

    $currentNews->title = $newsTitle;
    $currentNews->subject = $newsSubject;
    $currentNews->body = $newsBody;
    $currentNews->id_category = $newsCategory;

    $newsDao->update($currentNews);
    Message::setMessageInSession("success", "Notícia Atualizada com Sucesso!");


}else{
    Message::setMessageInSession("error", "Preencha Todos os Dados!");

}
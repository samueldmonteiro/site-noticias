<?php
require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Models\Auth;
use Src\Dao\NewsDaoMysql;
use Src\Utils\Redirect;
use Src\Utils\Filter;
use Src\Utils\Message;

$auth = new Auth($pdo, $base);
$newsDao = new NewsDaoMysql($pdo);

$userInfo = $auth->checkAuthentication(true);
$auth->onlyAdmin($userInfo);

if(!isset($_GET['news_id'])){
    Redirect::local("index.php");
}

$newsId = Filter::id($_GET['news_id']);
$currentNews = $newsDao->findById($newsId);

if(!$currentNews){
    Redirect::local("index.php");
}

require_once("partials/header.php");
?>

<div class="news-item" data-id="<?=$currentNews->id?>"></div>
<div class="container create-news update-news">
    <?php if(Message::getMessageInSession()):?>
        <div class="alert <?=Message::getMessageInSession()['style']?> text-center" role="alert">
            <?=Message::getMessageInSession()['msg']?>
            <?=Message::destroyMessageInSession()?>
        </div>
    <?php endif?>
    <form enctype="multipart/form-data" method="POST" action="<?=$base?>news_update_action.php">
        <input type="hidden" name="news-id" value="<?=$currentNews->id?>">
        <div class="alert alert-danger text-center message hide-message" role="alert"></div>

        <h4 class="mb-4">Atualizar Notícia</h4>
        <div class="mb-4">
            <label for="formFile" class="form-label">Capa da Notícia</label>
            <input class="form-control" type="file" id="formFile" name="news-cover">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Título da Notícia</label>
            <input type="text" name="news-title" class="form-control" id="exampleFormControlInput1" value="<?=$currentNews->title?>">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Assunto da Notícia</label>
            <input type="text" name="news-subject" class="form-control" id="exampleFormControlInput1" value="<?=$currentNews->subject?>">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Conteúdo na Notícia</label>
        </div>

        <label for="exampleFormControlInput1" class="form-label">Categoria</label>
        <select class="form-select mb-4" aria-label="Default select example" name="news-category">

            <?php foreach($categoriesList as $category):?>
                <?php if($category->id == $currentNews->id_category):?>
                    <option selected value="<?=$category->id?>"><?=$category->name?></option>
                    <?php continue?>
                <?php endif?>
                <option value="<?=$category->id?>"><?=$category->name?></option>
            <?php endforeach?>
        </select>

        <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
        <textarea name="news_body_update"></textarea>
        <script>
                CKEDITOR.replace( 'news_body_update' );
        </script>

    <button type="submit"  class="btn btn-primary">Publicar</button>

    </form>
</div>


<?php require_once("partials/footer.php")?>
<?php 

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Models\Auth;
use Src\Utils\Redirect;
use Src\Utils\Message;
use Src\Dao\NewsCategoryDaoMysql;

$auth = new Auth($pdo, $base);
$newsCategoryDao = new NewsCategoryDaoMysql($pdo);

$userInfo = $auth->checkAuthentication(true);

if(!$auth->isAdmin($userInfo)){
    Redirect::local("index.php");
}

$categoriesList = $newsCategoryDao->getAll();

require_once("partials/header.php");
?>

<div class="container create-news">
    <form enctype="multipart/form-data">
        <div class="alert alert-danger text-center message hide-message" role="alert"></div>

        <h4 class="mb-4">Publicar Nova Notícia</h4>
        <div class="mb-4">
            <label for="formFile" class="form-label">Capa da Notícia</label>
            <input class="form-control" type="file" id="formFile" name="news-cover">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Título da Notícia</label>
            <input type="text" name="news-title" class="form-control" id="exampleFormControlInput1">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Assunto da Notícia</label>
            <input type="text" name="news-subject" class="form-control" id="exampleFormControlInput1">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Conteúdo na Notícia</label>
        </div>

        <label for="exampleFormControlInput1" class="form-label">Categoria</label>
        <select class="form-select mb-4" aria-label="Default select example" name="news-category">

            <?php foreach($categoriesList as $category):?>
                <option value="<?=$category->name?>"><?=$category->name?></option>
            <?php endforeach?>
        </select>

        <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
        <textarea name="news_body"></textarea>
        <script>
                CKEDITOR.replace( 'news_body' );
        </script>

    <button type="button" id="create-news" class="btn btn-primary">Publicar</button>

    </form>
</div>




<?php require_once("partials/footer.php");?>
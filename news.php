<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Dao\NewsDaoMysql;
use Src\Models\Auth;
use Src\Utils\Filter;
use Src\Utils\Redirect;

$auth = new Auth($pdo, $base);
$newsDao = new NewsDaoMysql($pdo);


$userInfo = $auth->checkAuthentication(false);

if(!isset($_GET['news_id'])){
    Redirect::local("index.php");
}

$newsId = Filter::id($_GET['news_id']);
$newsItem = $newsDao->findById($newsId);

$newsList = $newsDao->getAllNews();

if(!$newsItem){
    die("<h3>Notícia não Encontrada...</h3>"); 
}

require_once("partials/header.php");
?>

<div class="container news">
    <div class="home-top">
        <span>News</span>
        <div class="search-by-news">
            <form method="POST" action="index.php">
                <button><i type="submit" class="bi bi-search"></i></button>
                <input type="text" name="search_news" placeholder="Buscar">             
            </form>
        </div>
    </div>

    <?php require("partials/news_item.php");?>

    <div class="container-news-mini-preview">
        <div class="mini-preview-top">
            <span>Posts Recentes</span>
            <a href="<?=$base?>">Ver todos</a>
        </div>

        <div class="items">
            
            <?php foreach($newsList as $newsMiniPreview):?>
                <?php if($newsItem->id != $newsMiniPreview->id):?>
                    <?php require("partials/news_mini_preview.php")?>
                <?php endif?>
            <?php endforeach?>
        </div>
    </div>
</div>


<?php require_once("partials/footer.php")?>

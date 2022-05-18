<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Dao\NewsDaoMysql;
use Src\Models\Auth;
use Src\Utils\Filter;
use Src\Utils\Redirect;
use Src\Dao\NewsViewDaoMysql;


if(!isset($_GET['news_id'])){
    Redirect::local("index.php");
}
$newsId = Filter::id($_GET['news_id']);

$auth = new Auth($pdo, $base);
$newsDao = new NewsDaoMysql($pdo);
$newsViewDao = new NewsViewDaoMysql($pdo, $newsId);

$userInfo = $auth->checkAuthentication(false);
$newsViewDao->checkView($newsId);

$newsItem = $newsDao->findById($newsId);

$newsInfo = $newsDao->getNewsFromHome(1, 4);
$newsList = $newsInfo['newsList'];

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

    <div class="news-comments">
        <span class="title">Comentários</span>
        <div class="news-comment-create">
            <?php if($userInfo):?>
                <img src="<?=$base?>media/users/<?=$userInfo->image?>" alt="" class="image-user">
            <?php else:?>
                <img src="<?=$base?>media/users/user.jpeg" alt="" class="image-user">
            <?php endif?>

            <div class="news-comment-create-content">
                <textarea name="comment-body" id="" cols="30" rows="10" placeholder="Digite aqui..."></textarea>
                <div class="news-comment-create-controls">
                    <button class="btn btn-secondary" id="post-comment">Publicar</button>
                </div>
            </div>
        </div>

        <div class="container-news-comment-items">
            
        </div>

        <p id="more-comments">Ver Mais</p>

        <div class="news-comment-item" style="display: none;">
                <img src="<?=$base?>media/users/user.jpeg" alt="" class="image-user">
                <div class="news-comment-item-content">
                    <div class="news-comment-item-info">
                        <a href="" class="username">Teste Teste</a>
                        <p class="post-date">1s</p>
                    </div>
                    <div class="news-comment-item-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, impedit. Non provident doloremque, perspiciatis a dolorum quasi culpa illo quod aliquam sunt error pariatur sequi in facilis officiis, quas ea!
                    </div>
                </div>
            </div>
    </div>
</div>


<?php require_once("partials/footer.php")?>

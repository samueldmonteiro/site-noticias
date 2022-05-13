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



if(!$newsItem){
    die("<h3>Notícia não Encontrada...</h3>"); 
}

require_once("partials/header.php");
?>

<!-- <p id="content" style="display:none; !important"><?=$newsItem->getBody()?></p>

<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

<textarea name="editor1"></textarea>
<script>
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.instances.editor1.setData(document.querySelector("#content").innerHTML);

</script> -->

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
            <a href="index.html">Ver todos</a>
        </div>

        <div class="items">
            <div class="news-mini-preview">
                <a href="index.html">
                    <div class="news-mini-preview-image">
                        <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
                    </div>

                    <div class="news-mini-preview-title">
                        10 regras de ouro para o planejamento estratégico
                    </div>
                    <div class="news-mini-preview-footer">
                        <div>
                            <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                            <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
                        </div>
                        <div class="likes-info">
                            <span id="num-likes">10</span>
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    
                </a>
            </div>

            <div class="news-mini-preview">
                <a href="index.html">
                    <div class="news-mini-preview-image">
                        <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
                    </div>

                    <div class="news-mini-preview-title">
                        10 regras de ouro para o planejamento estratégico
                    </div>
                    <div class="news-mini-preview-footer">
                        <div>
                            <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                            <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
                        </div>
                        <div class="likes-info">
                            <span id="num-likes">10</span>
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    
                </a>
            </div>

            <div class="news-mini-preview">
                <a href="index.html">
                    <div class="news-mini-preview-image">
                        <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
                    </div>

                    <div class="news-mini-preview-title">
                        10 regras de ouro para o planejamento estratégico
                    </div>
                    <div class="news-mini-preview-footer">
                        <div>
                            <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                            <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
                        </div>
                        <div class="likes-info">
                            <span id="num-likes">10</span>
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    
                </a>
            </div>

            <div class="news-mini-preview">
                <a href="index.html">
                    <div class="news-mini-preview-image">
                        <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
                    </div>

                    <div class="news-mini-preview-title">
                        10 regras de ouro para o planejamento estratégico
                    </div>
                    <div class="news-mini-preview-footer">
                        <div>
                            <span class="views-info"><i class="bi bi-eye"></i> 300</span>
                            <span class="comments-info"><i class="bi bi-chat-left-dots"></i> 5</span>
                        </div>
                        <div class="likes-info">
                            <span id="num-likes">10</span>
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    
                </a>
            </div>
        </div>
    </div>
</div>

<script src="<?=$base?>assets/js/newsBody.js"></script>


<?php require_once("partials/footer.php")?>

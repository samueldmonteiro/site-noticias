<?php 

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Dao\NewsDaoMysql;
use Src\Models\Auth;
use Src\Utils\Redirect;

$auth = new Auth($pdo, $base);
$newsDao = new NewsDaoMysql($pdo);

$userInfo = $auth->checkAuthentication(false);

$newsList = $newsDao->getAllNews();

// echo "<pre>";
// print_r($newsList);
// echo "</pre>";

require_once("partials/header.php");
?>

<div class="container home">
    <div class="home-top">
        <span>All News</span>
        <div class="search-by-news">
            <form method="POST" action="index.php">
                <button><i type="submit" class="bi bi-search"></i></button>
                <input type="text" name="search_news" placeholder="Buscar">             
            </form>
        </div>
    </div>

    <div class="container-news-home">

        <!-- <div class="news-preview-home">
            <div class="news-preview-home-image">
                <img src="assets/images/f69f0ddab5a5bff3e4d39520e1632772.webp" alt="">
            </div>
            <div class="news-preview-home-content">
                <div class="news-preview-home-head">
                    <div class="info-from-news">
                        <img src="assets/images/user.jpeg" alt="" class="image-user">
                        <div>
                            <div class="username">Administrador</div>
                            <div class="info-datetime">13 de Abril de 2022 <span class="info-time">  - 1 min</span></div>
                        </div>
                    </div>

                    <div class="dropdown">
                        <p type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-send"></i> Compartilhar</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pen"></i> Editar</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-trash3"></i> Deletar</a></li>
                        </ul>
                    </div>
                </div>

                <div class="news-preview-home-body">
                    <a href="news.php" class="news-title">A influência da estratégia humana nos negócios da familia</a>

                    <p class="news-subject">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed numquam totam itaque quae minima iure soluta nesciunt tenetur</p>
                </div>

                <div class="news-preview-home-footer">
                    <div>
                        <span class="views-info">300 visualizações</span>
                        <span class="comments-info">3 comentários</span>
                    </div>
                    <div class="likes-info">
                        <span id="num-likes">10</span>
                        <i class="bi bi-heart"></i>
                    </div>
                </div>
            </div>
        </div> -->

        <?php foreach($newsList as $newsItemPreviewHome):?>
            <?php require("partials/news_preview_home.php")?>
        <?php endforeach?>

    </div>
</div>

<?php require_once("partials/footer.php");?>
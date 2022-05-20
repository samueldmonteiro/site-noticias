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

$page = 1;
$perPage = 3;
if(isset($_GET['page'])){
    $page = Filter::id($_GET['page']);
}

if(isset($_GET['search_news']) && !empty($_GET['search_news'])){

    $querySearch = Filter::input($_GET['search_news']);
    $newsInfo = $newsDao->newsSearch($querySearch, $page, $perPage);

}elseif(isset($_GET['category'])){

    $categoryId = Filter::id($_GET['category']);
    $newsInfo = $newsDao->getNewsByCategory($categoryId, $page, $perPage);

}else{
    $newsInfo = $newsDao->getNewsFromHome($page, $perPage);
}

$newsList = $newsInfo['newsList'];

$paginationLinkbase = $base . "?page=";
if(isset($querySearch)){
    $paginationLinkbase = $base . "?search_news=$querySearch&page=";
}elseif(isset($categoryId)){
    $paginationLinkbase = $base . "?category=$categoryId&page=";

}

require_once("partials/header.php");
?>

<div class="container home">
    <?php require("partials/search_news.php")?>

    <div class="container-news-home">

        <?php if(!$newsList):?>
            <?php if(isset($querySearch)):?>
                <h3 class="text-center mt-4">Nenhum Resultado Para: <?=$querySearch?></h3>
            <?php else:?>
                <h3 class="text-center mt-4">Nenhuma Notícia Publicada</h3>
            <?php endif?>
        <?php else:?>
            <?php foreach($newsList as $newsItemPreviewHome):?>
                <?php require("partials/news_preview_home.php")?>
            <?php endforeach?>
        <?php endif?>

    </div>

    <?php if($newsInfo['totalPages']):?>
        <nav class="pagination-home">
            <ul class="pagination">
            
                <?php for($page=1;$page<=$newsInfo['totalPages'];$page++):?>
                    <li class="page-item">
                        <a class="page-link" href="<?=$paginationLinkbase?><?=$page?>">
                            <?=$page?>
                        </a>
                    </li>
                <?php endfor?>
            </ul>
        </nav>
    <?php endif?>

</div>

<?php require_once("partials/footer.php");?>
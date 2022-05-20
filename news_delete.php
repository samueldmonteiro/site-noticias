<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Dao\NewsCommentDaoMysql;
use Src\Dao\NewsDaoMysql;
use Src\Dao\NewsLikeDaoMysql;
use Src\Dao\NewsViewDaoMysql;
use Src\Models\Auth;
use Src\Utils\Filter;
use Src\Utils\Message;

$auth = new Auth($pdo, $base);
$newsDao = new NewsDaoMysql($pdo);

$userInfo = $auth->checkAuthentication(true);
$auth->onlyAdmin($userInfo);

$newsId = Filter::id($_POST['news-id']);

$currentNews = $newsDao->findById($newsId);

if($currentNews){

    $newsLikeDao = new NewsLikeDaoMysql($pdo);
    $newsCommentsDao = new NewsCommentDaoMysql($pdo);
    $newsViewsDao = new NewsViewDaoMysql($pdo);

    unlink("./media/news/" . $currentNews->cover);

    $newsDao->delete($newsId);
    $newsViewsDao->deleteViewsFromNews($newsId);
    $newsLikeDao->deleteLikesFromNews($newsId);
    $newsCommentsDao->deleteCommentsFromNews($newsId);

    Message::setMessageInSession("success", "Notícia Deletada com Sucesso!");
}

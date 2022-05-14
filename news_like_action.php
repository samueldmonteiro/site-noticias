<?php

use Src\Dao\NewsDaoMysql;
use Src\Dao\NewsLikeDaoMysql;
use Src\Dao\UserDaoMysql;
use Src\Models\Auth;
use Src\Models\NewsLike;
use Src\Utils\Filter;
use Src\Utils\Message;

require_once("vendor/autoload.php");
require_once("config/globals.php");

$auth = new Auth($pdo, $base);

$userInfo = $auth->checkAuthentication(false);

if(!$userInfo){
    Message::returnByAjax("error", "");
}

if(isset($_POST['news-id'])){

    $newsId = Filter::id($_POST['news-id']);

    $newsDao = new NewsDaoMysql($pdo);
    $newsId = Filter::id($_POST['news-id']);

    $newsItem = $newsDao->findById($newsId);

    if($newsItem){
        $newsLike = new NewsLike();
        $newsLike->id_user = $userInfo->id;
        $newsLike->id_news = $newsId;

        $newsLikeDao = new NewsLikeDaoMysql($pdo);
        $newsLikeDao->likeToggle($newsLike);
        Message::returnByAjax("success", "");

    }else{
        Message::returnByAjax("error", "");
    }
}
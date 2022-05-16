<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Utils\Filter;
use Src\Utils\Message;
use Src\Models\Auth;
use Src\Dao\NewsDaoMysql;
use Src\Dao\NewsCommentDaoMysql;
use Src\Models\NewsComment;
use Src\Utils\Validate;

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkAuthentication(false);
if(!$userInfo){
    Message::returnByAjax("error", "no login");
}

if(isset($_POST['news-id']) && isset($_POST['comment-body'])){

    $newsId = Filter::id($_POST['news-id']);
    $commentBody = Filter::input($_POST['comment-body']);

    if($newsId && $commentBody){

        $validate = new Validate($pdo);
        $newsDao = new NewsDaoMysql($pdo);


        $currentNews = $newsDao->findById($newsId);

        if(!$currentNews){
            Message::returnByAjax('false');
        }

        if(!$validate->dataSizeLimit([$commentBody], 300)){
            Message::returnByAjax('false');
        }

        $newsComment = new NewsComment();
        $newsComment->id_user = $userInfo->id;
        $newsComment->id_news = $newsId;
        $newsComment->body = $commentBody;
        $newsComment->created_at = date("Y-m-d H:i:s");

        $newsCommentDao = new newsCommentDaoMysql($pdo);
        $commentIdEntered = $newsCommentDao->insert($newsComment);

        $commentInformation = [
            "user_image" => $base . "media/users/" . $userInfo->getImage(),
            "user_name"  => $userInfo->name,
            "user_id"    => $userInfo->id,
            "comment_post_date" => $newsComment->created_at,
            "comment_body"      => $newsComment->getBody(),
        ];

        Message::returnByAjax('success', '',$commentInformation);

    }else{
        Message::returnByAjax('false');
    }
}

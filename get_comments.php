<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Dao\NewsCommentDaoMysql;
use Src\Utils\Filter;
use Src\Utils\Message;

if(isset($_POST['news-id']) && isset($_POST['limit'])){

    $newsId = Filter::id($_POST['news-id']);
    $limit = Filter::id($_POST['limit']);

    $newsCommentDao = new NewsCommentDaoMysql($pdo);
    $commentsByNews = $newsCommentDao->getCommentsByNews($newsId, $limit);

    foreach($commentsByNews as $key => $commentItem){

        $comment = [
            "user_image" => $base . "media/users/" . $commentItem->user->getImage(),
            "user_name"  => $commentItem->user->name,
            "user_id"    => $commentItem->user->id,
            "comment_post_date" => $commentItem->created_at,
            "comment_body"      => $commentItem->getBody()
        ];

        $commentsByNews[$key] = $comment;
    }

    Message::returnByAjax("success", "", $commentsByNews);

}

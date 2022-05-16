<?php

namespace Src\Dao;

use Src\Models\NewsComment;
use Src\Dao\UserDaoMysql;

class NewsCommentDaoMysql{

    public $pdo;

    public function __construct(\PDO $driver){
        $this->pdo = $driver;
    }

    public function buildNewsComment($data){
        $newsComment = new NewsComment();
        $newsComment->id = $data['id'];
        $newsComment->id_user = $data['id_user'];
        $newsComment->id_news = $data['id_news'];
        $newsComment->body = $data['body'];
        $newsComment->created_at = $data['created_at'];
        
        $userDao = new UserDaoMysql($this->pdo);
        $newsComment->user = $userDao->findById($newsComment->id_user);

        return $newsComment;
    }

    public function insert(NewsComment $newsComment){
        $stmt = $this->pdo->prepare("INSERT INTO news_comments 
        (id_user, id_news, body, created_at) VALUES 
        (:id_user, :id_news, :body, :created_at)");

        $stmt->bindValue(":id_user", $newsComment->id_user);
        $stmt->bindValue(":id_news", $newsComment->id_news);
        $stmt->bindValue(":body", $newsComment->body);
        $stmt->bindValue(":created_at", $newsComment->created_at);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function getCommentsByNews($newsId, $limit=false){


        if(!$limit){
            $stmt = $this->pdo->prepare("SELECT * FROM news_comments WHERE id_news=:id_news ORDER BY created_at DESC");
        }else{
            $stmt = $this->pdo->prepare("SELECT * FROM news_comments WHERE id_news=:id_news ORDER BY created_at DESC LIMIT :limit");
            $stmt->bindValue(":limit", $limit, \PDO::PARAM_INT);
        }

        $stmt->bindValue(":id_news", $newsId, \PDO::PARAM_INT);
        $stmt->execute();

        $commentsList = [];

        if($stmt->rowCount() > 0){
            foreach($stmt->fetchAll() as $newsCommentItem){
                $newsComment = $this->buildNewsComment($newsCommentItem);
                $commentsList[] = $newsComment;
            }
        }
        return $commentsList;
    }
}
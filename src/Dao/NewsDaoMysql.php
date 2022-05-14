<?php

namespace Src\Dao;

use Src\Models\News;
use Src\Dao\UserDaoMysql;
use Src\Dao\NewsLikeDaoMysql;
use Src\Models\Auth;

class NewsDaoMysql{

    protected $pdo;

    public function __construct(\PDO $driver){   
        $this->pdo = $driver;
    }

    public function buildNews($data, $allInfomations=false){
        $news = new News();
        $news->id = $data['id'];
        $news->id_user = $data['id_user'];
        $news->id_category = $data['id_category'];
        $news->created_at = $data['created_at'];
        $news->title = $data['title'];
        $news->subject = $data['subject'];
        $news->body = $data['body'];
        $news->cover = $data['cover'];

        if($allInfomations){

            $userDao = new UserDaoMysql($this->pdo);
            $newsLikeDao = new NewsLikeDaoMysql($this->pdo);
            $auth = new Auth($this->pdo, false);

            $currentUserInfo = $auth->checkAuthentication(false);

            $news->user = $userDao->findById($news->id_user);

            $news->countLikes = $newsLikeDao->getLikesFromNews($news->id);
            
            if($currentUserInfo){
                $news->isLiked = $newsLikeDao->likeExists($currentUserInfo->id, $news->id);
            }else{
                $news->isLiked = false;
            }
        }

        return $news;
    }

    public function insert(News $news){
        $stmt = $this->pdo->prepare("INSERT INTO news 
        (id_user, id_category, created_at, title, subject, body, cover) VALUES 
        (:id_user, :id_category, :created_at, :title, :subject, :body, :cover)");

        $stmt->bindValue(":id_user", $news->id_user);
        $stmt->bindValue(":id_category", $news->id_category);
        $stmt->bindValue(":created_at", $news->created_at);
        $stmt->bindValue(":title", $news->title);
        $stmt->bindValue(":subject", $news->subject);
        $stmt->bindValue(":body", $news->body);
        $stmt->bindValue(":cover", $news->cover);
        $stmt->execute();
    }


    public function getAllNews(){
        
        $stmt = $this->pdo->query("SELECT * FROM news ORDER BY created_at DESC");

        $newsList = [];

        if($stmt->rowCount() > 0){
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            foreach($data as $newsItem){
                $news = $this->buildNews($newsItem, true);
                $newsList[] = $news;
            }
        }

        return $newsList;
    }

    public function findById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
            $news = $this->buildNews($data, true);
            return $news;
           
        }else{
            return false;
        }
    }
}
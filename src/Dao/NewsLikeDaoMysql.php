<?php

namespace Src\Dao;

use Src\Models\NewsLike;


class NewsLikeDaoMysql{

    protected $pdo;

    public function __construct(\PDO $driver){   
        $this->pdo = $driver;
    }

    public function buildNewsLike($data){
        $newsLike = new NewsLike();
        $newsLike->id = $data['id'];
        $newsLike->id_user = $data['id_user'];
        $newsLike->id_news = $data['id_news'];
        return $newsLike;
    }

    public function insert(NewsLike $newsLike){

        $stmt = $this->pdo->prepare("INSERT INTO news_likes
        (id_user, id_news) VALUES 
        (:id_user, :id_news)");

        $stmt->bindValue(":id_user", $newsLike->id_user);
        $stmt->bindValue(":id_news", $newsLike->id_news);
        $stmt->execute();
    }

    public function likeExists($id_user, $id_news){
        
        $stmt = $this->pdo->prepare("SELECT * FROM news_likes WHERE id_user=:id_user AND id_news=:id_news");
        $stmt->bindValue(":id_user", $id_user);
        $stmt->bindValue(":id_news", $id_news);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $newsLikeItem = $this->buildNewsLike($stmt->fetch());
            return $newsLikeItem;
        }else{
            return false;
        }
    }

    public function getLikesFromNews($idNews){

        $stmt = $this->pdo->prepare("SELECT * FROM news_likes WHERE id_news=:id_news");
        $stmt->bindValue(":id_news", $idNews);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
        }else{
            return 0;
        }
    }

    public function delete($id){

        $stmt = $this->pdo->prepare("DELETE FROM news_likes WHERE id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }


    public function likeToggle(NewsLike $newsLike){

        $likeExists = $this->likeExists($newsLike->id_user, $newsLike->id_news);

        if($likeExists){
            $this->delete($likeExists->id);
        }else{
            $this->insert($newsLike);
        }
    }

    public function deleteLikesFromNews($newsId){
        $stmt = $this->pdo->prepare("DELETE FROM news_likes WHERE id_news=:id_news");
        $stmt->bindValue(":id_news",$newsId);
        $stmt->execute();
    }
}
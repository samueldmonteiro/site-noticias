<?php

namespace Src\Dao;

use Src\Models\News;
use Src\Dao\UserDaoMysql;
use Src\Dao\NewsLikeDaoMysql;
use Src\Models\Auth;
use Src\Dao\NewsViewDaoMysql;
use Src\Dao\NewsCommentDaoMysql;

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
            $newsCommentsDao = new NewsCommentDaoMysql($this->pdo);
            $newsViewDao = new NewsViewDaoMysql($this->pdo);
            $auth = new Auth($this->pdo, false);

            $currentUserInfo = $auth->checkAuthentication(false);

            $news->user = $userDao->findById($news->id_user);
            $news->countLikes = $newsLikeDao->getLikesFromNews($news->id);
            $news->countComments = count($newsCommentsDao->getCommentsByNews($news->id));
            $news->views = $newsViewDao->countViewsFromNews($news->id);
            
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

    public function update(News $news){
        $stmt = $this->pdo->prepare("UPDATE news SET 
        id_user=:id_user, id_category=:id_category, created_at=:created_at, title=:title, subject=:subject, body=:body, cover=:cover WHERE id=:id");


        $stmt->bindValue(":id_user", $news->id_user);
        $stmt->bindValue(":id_category", $news->id_category);
        $stmt->bindValue(":created_at", $news->created_at);
        $stmt->bindValue(":title", $news->title);
        $stmt->bindValue(":subject", $news->subject);
        $stmt->bindValue(":body", $news->body);
        $stmt->bindValue(":cover", $news->cover);
        $stmt->bindValue(":id", $news->id);
        $stmt->execute();
    }

    public function getNewsFromHome($page=1, $perPage){
        
        $pageOffset = ($page - 1) * $perPage;

        $stmt = $this->pdo->prepare("SELECT * FROM news ORDER BY created_at DESC LIMIT :page_offset,:per_page");
        $stmt->bindValue(":page_offset",$pageOffset, \PDO::PARAM_INT);
        $stmt->bindValue(":per_page",$perPage, \PDO::PARAM_INT);
        $stmt->execute();

        $newsInfo = [];
        $newsInfo['newsList'] = [];

        if($stmt->rowCount() > 0){
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            foreach($data as $newsItem){
                $news = $this->buildNews($newsItem, true);
                $newsInfo['newsList'][] = $news;
            }
        }

        $newsInfo['totalPages'] = ceil($this->countAllNews() / $perPage);
        return $newsInfo;
    }

    public function newsSearch($query,$page=1, $perPage){
      
        $pageOffset = ($page - 1) * $perPage;

        $stmt = $this->pdo->prepare("SELECT * FROM news  WHERE title LIKE :query ORDER BY created_at DESC LIMIT :page_offset,:per_page");
        $stmt->bindValue(":page_offset",$pageOffset, \PDO::PARAM_INT);
        $stmt->bindValue(":per_page",$perPage, \PDO::PARAM_INT);
        $stmt->bindValue(":query", "%".$query."%");
        $stmt->execute();

        $newsInfo = [];
        $newsInfo['newsList'] = [];

        if($stmt->rowCount() > 0){
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            foreach($data as $newsItem){
                $news = $this->buildNews($newsItem, true);
                $newsInfo['newsList'][] = $news;
            }
        }

        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE title LIKE :query");
        $stmt->bindValue(":query", "%".$query."%");
        $stmt->execute();

        $totalPages = ceil(count($stmt->fetchAll(\PDO::FETCH_ASSOC)) / $perPage);
        
        $newsInfo['totalPages'] = $totalPages;
        return $newsInfo;
    }

    public function countAllNews(){
        $stmt = $this->pdo->query("SELECT * FROM news");
        return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }


    public function getNewsByCategory($id_category, $page,$perPage){

        $pageOffset = ($page - 1) * $perPage;

        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE id_category=:id_category ORDER BY created_at DESC LIMIT :page_offset,:per_page");
        $stmt->bindValue(":page_offset",$pageOffset, \PDO::PARAM_INT);
        $stmt->bindValue(":per_page",$perPage, \PDO::PARAM_INT);
        $stmt->bindValue(":id_category", $id_category);
        $stmt->execute();

        $newsInfo = [];
        $newsInfo['newsList'] = [];

        if($stmt->rowCount() > 0){
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            foreach($data as $newsItem){
                $news = $this->buildNews($newsItem, true);
                $newsInfo['newsList'][] = $news;
            }
        }

        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE id_category=:id_category");
        $stmt->bindValue(":id_category", $id_category);
        $stmt->execute();

        $totalPages = ceil(count($stmt->fetchAll(\PDO::FETCH_ASSOC)) / $perPage);
        
        $newsInfo['totalPages'] = $totalPages;
        return $newsInfo;
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

    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM news WHERE id=:id");
        $stmt->bindValue(":id",$id);
        $stmt->execute();
    }
}
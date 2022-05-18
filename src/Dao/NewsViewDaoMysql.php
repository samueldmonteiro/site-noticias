<?php

namespace Src\Dao;

use Src\Models\NewsView;

class NewsViewDaoMysql{

    public $pdo;

    public function __construct(\PDO $driver){
        $this->pdo = $driver;
    }

    public function checkView($id_page){
        
        $newsView = new NewsView();
        $newsView->ip = $_SERVER['REMOTE_ADDR'];
        $newsView->datetime = date("Y-m-d");
        $newsView->id_page = $id_page;
        
        $stmt = $this->pdo->prepare("SELECT * FROM news_views WHERE ip=:ip AND datetime=:datetime AND id_page=:id_page");
        $stmt->bindValue(":ip",$newsView->ip);
        $stmt->bindValue(":datetime", $newsView->datetime);
        $stmt->bindValue(":id_page", $newsView->id_page);
        $stmt->execute();

        if($stmt->rowCount() < 1){
            $this->addView($newsView);
        }
    }

    public function addView(NewsView $newsView){
        $stmt = $this->pdo->prepare("INSERT INTO news_views 
        (ip, datetime, id_page) VALUES 
        (:ip, :datetime, :id_page)");

        $stmt->bindValue(":ip",$newsView->ip);
        $stmt->bindValue(":datetime", $newsView->datetime);
        $stmt->bindValue(":id_page", $newsView->id_page);

        $stmt->execute();
    }

    public function buildNewsView($data){

        $newsView = new NewsView();
        $newsView->id = $data['id'];
        $newsView->ip = $data['ip'];
        $newsView->datetime = $data['datetime'];
        $newsView->id_page = $data['id_page'];
        return $newsView;
    }


    public function countViewsFromNews($id_page){
        $stmt = $this->pdo->prepare("SELECT * FROM news_views WHERE id_page=:id_page");
        $stmt->bindValue(":id_page", $id_page);
        $stmt->execute();

        return count($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }


}
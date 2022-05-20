<?php

namespace Src\Dao;

use Src\Models\NewsCategory;

class NewsCategoryDaoMysql{

    public $pdo;

    public function __construct(\PDO $driver){
        $this->pdo = $driver;
    }

    public function buildNewsCategory($data){
        $newsCategory = new NewsCategory();
        $newsCategory->name = $data['name'];
        $newsCategory->id = $data['id'];
        return $newsCategory;
    }

    public function getAll(){
        $stmt = $this->pdo->query("SELECT * FROM news_categories");

        $newsCategories = [];

        if($stmt->rowCount() > 0){
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach($data as $newsCategoryItem){
                $newsCategory = $this->buildNewsCategory($newsCategoryItem);
                $newsCategories[] = $newsCategory;
            }
        }

        return $newsCategories;
    }

    public function findByName($newsCategory){
        $stmt = $this->pdo->prepare("SELECT * FROM news_categories WHERE name=:name");
        $stmt->bindValue(":name",$newsCategory);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);
            $newsCategory = $this->buildNewsCategory($data);
            return $newsCategory;
        }

        return false;
    }


    public function findById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM news_categories WHERE id=:id");
        $stmt->bindValue(":id",$id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);
            $newsCategory = $this->buildNewsCategory($data);
            return $newsCategory;
        }

        return false;
    }
}
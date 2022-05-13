<?php

namespace Src\Utils;

use Src\Dao\UserDaoMysql;
use Src\Dao\NewsCategoryDaoMysql;

class Validate{

    private $pdo;

    public function __construct(\PDO $driver){
        $this->pdo = $driver;
    }

    public static function dataSizeLimit($values, $maxSize){
        foreach($values as $value){
            if(strlen($value) > $maxSize){
                return false;
            }
        }
        return true;
    }

    public static function isValidEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function nameExists($name){

        $userDao = new UserDaoMysql($this->pdo);
        return $userDao->findByName($name);
    }

    public function emailExists($email){
        $userDao = new UserDaoMysql($this->pdo);
        return $userDao->findByEmail($email);
    }

    public function newsCategoryExists($newsCategory){
        $newsCategoryDao = new NewsCategoryDaoMysql($this->pdo);
        return $newsCategoryDao->findByName($newsCategory);
    }
}
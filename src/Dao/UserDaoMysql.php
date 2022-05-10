<?php

namespace Src\Dao;

use Src\Models\User;

class UserDaoMysql{

    public $pdo;
    
    public function __construct(\PDO $driver){
        $this->pdo = $driver;
    }

    public function buildUser($data){

        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->image = $data['image'];
        $user->level = $data['level'];
        $user->token = $data['token'];

        return $user;
    }

    public function insert(User $user, $authenticate=false){

        $stmt = $this->pdo->prepare("INSERT INTO users 
        (name, email, password, token, level) VALUES 
        (:name, :email, :password, :token, :level)");

        $stmt->bindValue(":name", $user->name);
        $stmt->bindValue(":email", $user->email);
        $stmt->bindValue(":password", $user->password);
        $stmt->bindValue(":token", $user->token);
        $stmt->bindValue(":level", $user->level);
        $stmt->execute();

        if($authenticate){
            $this->authenticateUser($user->token);
        }
    }

    public function authenticateUser($token){
        $_SESSION['token'] = $token;
    }

    public function update(User $user){}
    public function findById($id){}

    public function findByToken($token){

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE token=:token");
        $stmt->bindValue(":token", $token);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
            $user = $this->buildUser($data);
            return $user;
           
        }else{
            return false;
        }
    }

    public function findByName($name){

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE name=:name");
        $stmt->bindValue(":name", $name);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
            $user = $this->buildUser($data);
            return $user;
           
        }else{
            return false;
        }
    }

    public function findByEmail($email){

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
            $user = $this->buildUser($data);
            return $user;
           
        }else{
            return false;
        }
    }
}

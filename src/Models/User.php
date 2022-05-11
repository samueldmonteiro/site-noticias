<?php

namespace Src\Models;

class User{

    public $id;
    public $name;
    public $email;
    public $password;
    public $image;
    public $token;
    public $level;

    public function getImage(){
        
        if(empty($this->image)){
            $this->image = "user.jpeg";
        }
        return $this->image;
    }
}

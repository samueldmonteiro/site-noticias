<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Utils\Filter;
use Src\Models\Auth;
use Src\Utils\Message;

$auth = new Auth($pdo, $base);

$email = Filter::input($_POST['email']);
$password = Filter::input($_POST['password']);

if($email && $password){

    if($auth->checkLogin($email, $password)){
        Message::setMessageInSession("success","Login Efetuado com Sucesso!");
    }else{
        Message::setMessageInSession("error","Email ou Senha Incorretos!");
    }
    
}else{
    Message::setMessageInSession("error","Preencha Todos os Campos!");
}
<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Dao\UserDaoMysql;
use Src\Models\User;
use Src\Utils\Message;
use Src\Utils\Filter;
use Src\Utils\Validate;
use Src\Models\Auth;

$validate = new Validate($pdo);
$auth = new Auth($pdo, $base);

$name = Filter::input($_POST['name']);
$email = Filter::input($_POST['email']);
$password = Filter::input($_POST['password']);
$confirmPassword = Filter::input($_POST['confirm_password']);

if($name && $email && $password && $confirmPassword){

    if(!$validate->dataSizeLimit([$name, $email, $password, $confirmPassword], 30)){
        Message::returnByAjax("error", "Preencha os Dados Corretamente!");
    }

    if($validate->nameExists($name)){
        Message::returnByAjax("error", "Este Nome de Usuário já está Cadastrado!");
    }

    if($validate->emailExists($email)){
        Message::returnByAjax("error", "Este Email já está Cadastrado!");
    }

    if(!$validate->isValidEmail($email)){
        Message::returnByAjax("error", "Este Email não é Válido!");
    }

    if($password != $confirmPassword){
        Message::returnByAjax("error", "As Senhas Prescisam ser Iguais!");
    }

    $passwordHash = $auth->buildPasswordHash($password);
    $token = $auth->buildToken();

    $newUser = new User();
    $newUser->name = $name;
    $newUser->email = $email;
    $newUser->password = $passwordHash;
    $newUser->token = $token;
    $newUser->level = "normal";

    $userDao = new UserDaoMysql($pdo);
    
    $userDao->insert($newUser);
    $auth->authenticateUser($token);
    Message::returnByAjax("success", "Conta Registrada com Sucesso!");

}else{
    Message::returnByAjax("error", "Preencha Todos os Campos!");

}

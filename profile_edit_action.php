<?php

require_once("vendor/autoload.php");
require_once("config/globals.php");

use Src\Dao\UserDaoMysql;
use Src\Utils\Filter;
use Src\Utils\Validate;
use Src\Models\Auth;
use Src\Utils\Redirect;
use Src\Utils\Message;
use Src\Upload\ImageUpload;

$auth = new Auth($pdo, $base);
$validate = new Validate($pdo);

$userInfo = $auth->checkAuthentication(true);

$name = Filter::input($_POST['name']);
$email = Filter::input($_POST['email']);

if($name && $email){

    if(!$validate->dataSizeLimit([$name, $email],30)){
        Redirect::local("back");
    }

    if($validate->nameExists($name) && $name != $userInfo->name){
        Message::setMessageInSession("error", "Este Nome de Usuário já está Cadastrado!");
    }

    if($validate->emailExists($email) && $email != $userInfo->email){
        Message::setMessageInSession("error", "Este Email já está Cadastrado!");
    }

    if(!$validate->isValidEmail($email)){
        Message::setMessageInSession("error", "Este Email é Inválido");
    }

    $userInfo->name = $name;
    $userInfo->email = $email;

    if(!empty($_FILES['image']['name'])){

        $imageUser = $_FILES['image'];
        $localUpload = "./media/users/";

        $imageUpload = new ImageUpload($imageUser, 200,200, $localUpload);

        if($imageUpload->getAlert()){
            Message::setMessageInSession("error", $imageUpload->getAlert());
        }

        if(!empty($userInfo->image)){
            unlink($localUpload . $userInfo->image);
        }

        $userInfo->image = $imageUpload->imageNameFile;
    }

    $userDao = new UserDaoMysql($pdo);
    $userDao->update($userInfo);
    Message::setMessageInSession("success", "Dados Atualizados com Sucesso!");

}else{
    Message::setMessageInSession("error", "Preencha Todos os Campos!");
}

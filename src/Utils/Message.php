<?php

namespace Src\Utils;

use Src\Utils\Redirect;
class Message{

    public static function returnByAjax($type, $msg=false, $data=false){
        $values = [
            "type" => $type,
            "msg"  => $msg,
            "data" => $data
        ];

        $jsonValues = json_encode($values);
        echo $jsonValues;
        exit;
    }

    public static function setMessageInSession($type, $msg){
        $_SESSION['message'] = ['type' => $type, "msg" => $msg];
        Redirect::local("back");
    }

    public static function getMessageInSession(){

        if(isset($_SESSION['message'])){
            $type = $_SESSION['message']['type'];
            $msg = $_SESSION['message']['msg'];

            if($type == "error"){
                $styleFromMessage = "alert-danger";
            }else{
                $styleFromMessage = "alert-primary";
            }    
            return ['style' => $styleFromMessage, "msg" => $msg];

        }else{
            return false;
        }
    }

    public static function destroyMessageInSession(){
        unset($_SESSION['message']);
    }
}
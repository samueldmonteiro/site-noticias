<?php

namespace Src\Utils;

class Message{

    public static function return($type, $msg, $data=false){

        $values = [
            "type" => $type,
            "msg"  => $msg,
            "data" => $data
        ];

        $jsonValues = json_encode($values);
        echo $jsonValues;
        exit;
    }
}
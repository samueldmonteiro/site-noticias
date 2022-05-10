<?php

namespace Src\Utils;

class Redirect{

    public static function local($local){
        global $base;

        if($local == "back"){
            $local = $_SERVER['HTTP_REFERER'];
            header("Location: " . $local);
        }else{
            header("Location: " . $base . $local);
        }
        exit;
    }
}
<?php

namespace Src\Utils;

class Redirect{

    public static function local($base, $local){

        if($local == "back"){
            $local = $_SERVER['HTTP_REFERER'];
        }

        header("Location: " . $base . $local);
        exit;
    }
}
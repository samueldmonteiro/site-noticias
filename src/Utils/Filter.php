<?php

namespace Src\Utils;

class Filter{

    public static function general($value){
        $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        return $value;
    }

    public static function input($input){
        $input = strip_tags($input);
        $input = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
        $input = addslashes($input);
        return $input;
    }
}
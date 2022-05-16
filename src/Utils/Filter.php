<?php

namespace Src\Utils;

class Filter{

    public static function general($value){
        $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        return trim($value);
    }

    public static function input($input){
        $input = strip_tags($input);
        $input = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
        return trim($input);
        
    }

    public static function newsBody($newsBody){

        $replaceStrings = [
            '<script', 'onerror=', 'prompt\(', 'javascript:', 'alert\(', 'onclick', 'onmouse',
            'onresize', 'onblur', 'onscroll=', 'onpage', 'onfocus=', 'onload=', 'script>',
            'onkey=', 'onunload=', '<iframe', '<frameset', '<body', '<html', '<object',
            '<applet', '<bgsound', 'onstart='
        ];
        
        foreach($replaceStrings as $replace){
            $patten = "/$replace/i";  
            $newsBody = preg_replace($patten, "", $newsBody);
        }
        
        $newsBody = filter_var($newsBody, FILTER_SANITIZE_SPECIAL_CHARS);
        return $newsBody;
    }

    public static function id($id){
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $id = addslashes($id);
        return trim($id);
    }
}
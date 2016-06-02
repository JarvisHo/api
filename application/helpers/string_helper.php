<?php

function is_exist($string){
    if(isset($string)){

        if(empty($string) OR $string==''){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}

function auto_fix($str){
    $str = str_replace ("<","",$str);
    $str = str_replace (">","",$str);
    $str = str_replace (";","",$str);
    $str = str_replace (",","",$str);
    $str = str_replace ("'","",$str);
    $str = str_replace ("''","",$str);
    $str = str_replace ("+","",$str);
    $str = str_replace ("-","",$str);
    $str = str_replace ("*","",$str);
    $str = str_replace ("&","",$str);
    $str = str_replace ("=","",$str);
    $str = str_replace ("DROP","",$str);
    $str = str_replace ("SELECT","",$str);
    $str = str_replace ("(","",$str);
    $str = str_replace (")","",$str);

    return $str;
}
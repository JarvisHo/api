<?php

function display_error($string){

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
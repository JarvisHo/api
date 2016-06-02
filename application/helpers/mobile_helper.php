<?php

function is_mobile()
{
    //Detect special conditions devices
    $iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
    if(stripos($_SERVER['HTTP_USER_AGENT'],"Android") && stripos($_SERVER['HTTP_USER_AGENT'],"mobile")){
        $Android = true;
    }else if(stripos($_SERVER['HTTP_USER_AGENT'],"Android")){
        $Android = false;
        $AndroidTablet = true;
    }else{
        $Android = false;
        $AndroidTablet = false;
    }
    $webOS = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $BlackBerry = stripos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $RimTablet= stripos($_SERVER['HTTP_USER_AGENT'],"RIM Tablet");

    //do something with this information
    if( $iPod || $iPhone ){
        //were an iPhone/iPod touch -- do something here
    }else if($iPad){
        return false;
        //were an iPad -- do something here
    }else if($Android){
        //we're an Android Phone -- do something here
    }else if($AndroidTablet){
        return false;
        //we're an Android Phone -- do something here
    }else if($webOS){
        //we're a webOS device -- do something here
    }else if($BlackBerry){
        //we're a BlackBerry phone -- do something here
    }else if($RimTablet){
        //we're a RIM/BlackBerry Tablet -- do something here
    }else{
        return false;
    }

    return true;
}
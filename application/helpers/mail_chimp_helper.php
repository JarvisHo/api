<?php
function get_first_name($full_name) {

    //chinese name editor
    if(mb_strlen($full_name,"utf8") == 4){
        $first_name = mb_substr($full_name,2,2,"utf-8");
    }else if(mb_strlen($full_name,"utf8") == 3){
        $first_name = mb_substr($full_name,1,2,"utf-8");
    }else if(mb_strlen($full_name,"utf8") == 2){
        $first_name = mb_substr($full_name,1,1,"utf-8");
    }else if(stristr($full_name,' ')){
        $temp_array = explode(" ", $full_name);
        $first_name = $temp_array[0];
    }else{
        $first_name = $full_name;
    }

    return $first_name;
    
}

function get_last_name($full_name){

    $last_name = "default_last_name"; //姓

    //chinese name editor
    if(mb_strlen($full_name,"utf8") == 4){
        $last_name = mb_substr($full_name,0,2,"utf-8");
    }
    if(mb_strlen($full_name,"utf8") == 3){
        $last_name = mb_substr($full_name,0,1,"utf-8");
    }
    if(mb_strlen($full_name,"utf8") == 2){
        $last_name = mb_substr($full_name,0,1,"utf-8");
    }
    //english name editor
    if(stristr($full_name,' ')){
        $temp_array = explode(" ", $full_name);
        $last_name = $temp_array[1];
    }

    return $last_name;
}

function set_mail_chimp_to_prospect($email, $full_name){

    $first_name = get_first_name($full_name);
    $last_name = get_last_name($full_name);

    //新增到 MailChimp Prospect list
    $MailChimp = new \Drewm\MailChimp('528c00f4326256c03530f4c485389a53-us11');
    $MailChimp->call('lists/subscribe', array(
        'id'                => '59717b8a4a',
        'email'             => array('email'=> $email),
        'merge_vars'        => array('FNAME'=> $first_name, 'LNAME'=>$last_name),
        'double_optin'      => false,
        'update_existing'   => true,
        'replace_interests' => false,
        'send_welcome'      => false,
    ));

}

function set_mail_chimp_to_member($email, $full_name){

    $first_name = get_first_name($full_name);
    $last_name = get_last_name($full_name);

    //刪除 MailChimp Prospect list
    $MailChimp = new \Drewm\MailChimp('528c00f4326256c03530f4c485389a53-us11');
    $MailChimp->call('lists/unsubscribe', array(
        'id'                => '59717b8a4a',
        'email'             => array('email'=> $email),
        'merge_vars'        => array('FNAME'=> $first_name, 'LNAME'=>$last_name),
        'double_optin'      => false,
        'update_existing'   => true,
        'replace_interests' => false,
        'send_welcome'      => false,
    ));

    //新增到 MailChimp Member list
    $MailChimp->call('lists/subscribe', array(
        'id'                => '5712aa5f68',
        'email'             => array('email'=> $email),
        'merge_vars'        => array('FNAME'=> $first_name, 'LNAME'=>$last_name),
        'double_optin'      => false,
        'update_existing'   => true,
        'replace_interests' => false,
        'send_welcome'      => false,
    ));
}

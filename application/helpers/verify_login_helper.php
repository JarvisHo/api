<?php

function verify_login_admin($user_data)
{
    $error = false;

    if(isset($user_data['logged_in']))
    {
        if($user_data['logged_in'] == 1)
        {
            if(isset($user_data['level']))
            {
                if($user_data['level'] > 1){
                    //合法登入
                }else $error = true;
            }else $error = true;
        }else $error = true;
    }else $error = true;

    if($error)
    {
        $this->session->sess_destroy();
        redirect('/admin/login', 'location', 301);
    }

}


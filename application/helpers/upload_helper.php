<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*###################################################################################*/
function multiple_upload($name = 'userfile', $upload_dir = 'images', $allowed_types = 'gif|jpg|jpeg|jpe|png', $size=0)
    /*###################################################################################*/
{
    $CI =& get_instance();

    $config['upload_path']   = realpath($upload_dir);
    $config['allowed_types'] = $allowed_types;
    $config['max_size']      = $size;
    $config['overwrite']     = FALSE;
    $config['encrypt_name']  = TRUE;

    $CI->upload->initialize($config);
    $errors = FALSE;

    if(!$CI->upload->do_upload($name)):
        $errors = TRUE;
    else:
        // Build a file array from all uploaded files
        $files = $CI->upload->data();
    endif;

    echo $errors;

    // There was errors, we have to delete the uploaded files
    if($errors):
        @unlink($files['full_path']);
        return false;
    else:
        return $files;
    endif;

}//end of multiple_upload()
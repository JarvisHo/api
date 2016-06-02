<?php

function echoError($reason){

    $response['member_command'] = "ERROR: ".$reason;
    echo json_encode($response);

}

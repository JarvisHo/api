<?php
require_once('GetResponse.php');

if(isset($_POST['email'])){

    $api = new GetResponse('0b73e06f96aaa6a68279f228b4c89233');

    $contactEmail = (array)$api->getContactsByEmail($_POST['email']);
    $contactEmailID = array_keys($contactEmail);
    $deleteResponse = $api->deleteContact($contactEmailID[0]);

    var_dump($api->addContact("VCex9", 'pawmaji_sales', $_POST['email']));

}
//pawmaji_leads
//VCJbR

//pawmaji_sales
//VCex9

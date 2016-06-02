<?php
require_once('GetResponse.php');

if(isset($_POST['email'])){

    $api = new GetResponse('0b73e06f96aaa6a68279f228b4c89233');

    var_dump($api->addContact("VCJbR", 'pawmaji_leads', $_POST['email']));

}

<?php

require_once '../config.inc.php';


if(!isset($_REQUEST['action'])) {
    echo json_encode(array("error" => "action is mandatory"));
    die();
} else {
    $action = $_REQUEST['action'];
}

function test() {
    echo json_encode(array("success" => "Test is ok"));
}

switch($action) {
   case 'test':
       test();
       break;
   default:
       echo json_encode(array("error" => "action $action is not recognized"));
       break;
}


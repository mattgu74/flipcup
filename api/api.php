<?php

require_once '../config.inc.php';


if(!isset($_REQUEST['action'])) {
    echo json_encode(array("error" => "action is mandatory"));
}


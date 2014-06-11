
<?php

include '../config.inc.php';
include 'db.php';

if(!isset($_REQUEST['action'])) {
    echo json_encode(array("error" => "action is mandatory"));
    die();
} else {
    $action = $_REQUEST['action'];
}

function test() {
    echo json_encode(array("success" => "Test is ok"));
}

function allteam() {
    global $db;
    $resultats=$db->query("SELECT * FROM team;");
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    $result = array();
    while( $ligne = $resultats->fetch() )
    {
            $result[] = $ligne;
    }
    $resultats->closeCursor();
    echo json_encode(array("success" => $result));
}

function addteam() {
    // Check all parameter is there
    if( !( 
            (isset($_REQUEST['name'])) && 
            (isset($_REQUEST['login1'])) && 
            (isset($_REQUEST['login2'])) && 
            (isset($_REQUEST['login3'])) && 
            (isset($_REQUEST['login4'])) && 
            (isset($_REQUEST['login5']))
        )) 
    {
        echo json_encode(array("error" => "a parameter is missing"));
        die();
    }

    // Add the team
    global $db;

    $req=$db->prepare("INSERT INTO team (name, login1, login2, login3, login4, login5) VALUES (:name, :login1, :login2, :login3, :login4, :login5)"); // on prépare notre requête
    $req->execute(array(
        'name' => $_REQUEST['name'],
        'login1' => $_REQUEST['login1'],
        'login2' => $_REQUEST['login2'],
        'login3' => $_REQUEST['login3'],
        'login4' => $_REQUEST['login4'],
        'login5' => $_REQUEST['login5'],
     ));

    echo json_encode(array("success" => "Team added"));
}

switch($action) {
    case 'test':
        test();
        break;
    case 'allteam':
        allteam();
        break;
    case 'addteam':
        addteam();
        break;
    default:
        echo json_encode(array("error" => "action $action is not recognized"));
        break;
}


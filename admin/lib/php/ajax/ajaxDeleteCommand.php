<?php
header('Content-Type: application/json');
require '../dbConnect.php';
require '../classes/Connection.class.php';
require '../classes/Guild.class.php';
require '../classes/CommandDB.class.php';

$cnx = Connection::getInstance($dsn,$user,$pass);

try{      
   $update= new CommandDB($cnx);
   extract($_GET,EXTR_OVERWRITE);
    $update->deleteCommand($id);
    print json_encode($update); 
}
catch(PDOException $e){
    print $e->getMessage()." ".$e->getLine()." ".$e->getTrace()." ".$e->getCode();
}

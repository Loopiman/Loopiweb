<?php

header('Content-Type: application/json');
require '../dbConnect.php';
require '../classes/Connection.class.php';
require '../classes/Guild.class.php';
require '../classes/MemberDB.class.php';

$cnx = Connection::getInstance($dsn, $user, $pass);

try {
    $b = new MemberDB($cnx);

    extract($_GET, EXTR_OVERWRITE);
    $bien = $b->getMember();

    print json_encode($bien); 
} catch (PDOException $e) {
    print $e->getMessage() . " " . $e->getLine() . " " . $e->getTrace() . " " . $e->getCode();
}

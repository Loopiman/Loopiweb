<?php
header('Content-Type: application/json');

require '../dbConnect.php';
require '../classes/Connection.class.php';
require '../classes/VueMembers.class.php';

$cnx = Connection::getInstance($dsn, $user, $pass);

try {
    $m = new VueMembers($cnx);
    extract($_GET, EXTR_OVERWRITE);
    $member = $m->getMemberTag($tag);
    print json_encode($member);
} catch (PDOException $e) {
    print $e->getMessage() . " " . $e->getLine() . " " . $e->getTrace() . " " . $e->getCode();
}

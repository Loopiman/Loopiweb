<?php
header('Content-Type: application/json');
require '../dbConnect.php';
require '../classes/Connection.class.php';
require '../classes/Role.class.php';

$cnx = Connection::getInstance($dsn, $user, $pass);

try {
  $r = new Role($cnx);
  extract($_POST, EXTR_OVERWRITE);
  $role = $r->getRole();
  print json_encode($role);
} catch (PDOException $e) {
  print $e->getMessage() . " " . $e->getLine() . " " . $e->getTrace() . " " . $e->getCode();
}

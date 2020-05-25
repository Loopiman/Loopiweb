<?php
header('Content-Type: application/json');
require '../dbConnect.php';
require '../classes/Connection.class.php';
require '../classes/Guild.class.php';
require '../classes/CommandDB.class.php';

$cnx = Connection::getInstance($dsn,$user,$pass);

try{      
   //Instanciation de la classe BienBD
   $update= new CommandDB($cnx);
   //extraction des données du tableau $_GET 
   extract($_GET,EXTR_OVERWRITE);
/*id, champ et nouveau sont les paramètres accompagnant l'url dont la chaîne a été créé dans la fonction jquery et stockée dans la variable parametre. */
    $update->addCommand($n, $r);
   //retour à jquery encodé en Json (tableau avec la syntaxe Javascript)
    print json_encode($update); 
}
catch(PDOException $e){
    print $e->getMessage()." ".$e->getLine()." ".$e->getTrace()." ".$e->getCode();
}

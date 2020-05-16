<?php

class Connection
{

  private static $_instance = null;

  public static function getInstance($dsn, $user, $pass)
  {
    if (!self::$_instance) {
      // si l'instance (ou objet) de connexion n'existe pas encore, on le créé
      try {
        self::$_instance = new PDO($dsn, $user, $pass);

        self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $e) {
        print "Erreur de connexion : " . $e->getMessage() . " " . $e->getLine();

        //print "pass : ".$pass. " user = ".$user;
      }
    }
    return self::$_instance;  //retour de l'instance de connexion
  }
}

<?php
//Classe métier minimale
class Guild {
   //les attributs, ou variables, de classe
    private $_attributs = array();

   //le constructeur 
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    //hydrate les données  fournit les données aux accesseurs
    //$data contient un résultset venant de la BD, et envoyé depuis la classe DAO
    public function hydrate(array $data) {
        foreach ($data as $setter => $value) {
            $this->$setter = $value;
            //le setter reçoit son nom ($setter) et sa valeur ($value)
        }
    }

    //Tous les getters : appelés depuis une page de l'application
    public function __get($nom) {
        if (isset($this->_attributs[$nom])) {
            return $this->_attributs[$nom];
        }
    }

    //Tous les setters : ils reçoivent leurs noms et valeurs de la méthode hydrate
    public function __set($nom_setter, $valeur) {
        $this->_attributs[$nom_setter] = $valeur;
    }

}
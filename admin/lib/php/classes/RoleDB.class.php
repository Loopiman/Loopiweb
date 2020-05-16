<?php

class RoleDB extends Guild {

   private $_db;
   private $_array = array();


    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getRole() {
        try {
            $this->_db->beginTransaction();
            $query = "select role.name, role.position as pos from role where role.guild_id = '" . $_SESSION['guild_id'] . "' order by role.position desc";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $this->_db->commit();
            while ($data = $resultset->fetch()) {
                $_array[] = new Guild($data); 
            }

        } catch (PDOException $e) {
            print $e->getMessage();
        }
        if (!empty($_array)) {
            return $_array;
        } else {
            return null;
        }
    }
}
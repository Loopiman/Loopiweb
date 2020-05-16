<?php

class GuildDB extends Guild {

   private $_db;
   private $_array = array();


    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getGuild() {
        try {
            $this->_db->beginTransaction();
            $query = "select * from guild where owner_id = '" . $_SESSION['user'] . "' and available = true";
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

    public function getGuildName() {
        try {
            $this->_db->beginTransaction();
            $query = "select name from guild where guild_id = '".$_SESSION['guild_id']."'";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $this->_db->commit();
            $res = $resultset->fetch();
            $_array[0] = new Guild($res);

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
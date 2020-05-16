<?php

class BanDB extends Guild {

   private $_db;
   private $_array = array();


    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getBan() {
        try {
            $this->_db->beginTransaction();
            $query = "select member.avatar, member.tag, ban.reason, ban.ban_date FROM member join ban on member.member_id = ban.member_id where ban.guild_id = '" . $_SESSION['guild_id'] . "'";
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
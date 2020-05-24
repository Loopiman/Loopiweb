<?php

session_start();
class GuildDB extends Guild
{

    private $_db;
    private $_array = array();


    public function __construct($db)
    { //contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getGuild()
    {
        try {
            $this->_db->beginTransaction();
            $query = "select g.available, g.name from guild g join join_guild j on g.guild_id = j.guild_id where j.admin = true and j.member_id = '" . $_SESSION['user'] . "'";
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

    public function getGuildName()
    {
        try {
            $this->_db->beginTransaction();
            $query = "select name from guild where guild_id = '" . $_SESSION['guild_id'] . "'";
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

    public function verifAdmin()
    {
        try {
            $this->_db->beginTransaction();
            $query = "select count(*) as isadmin from join_guild where member_id = '" . $_SESSION['user'] . "' and guild_id = '" . $_SESSION['guild_id'] . "' and admin = true ";
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

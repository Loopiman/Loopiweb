<?php

class CommandDB extends Guild
{

    private $_db;
    private $_array = array();


    public function __construct($db)
    { //contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getCommand()
    {
        try {
            session_start();
            $this->_db->beginTransaction();
            $query = "select command.name, command.command_id, command.response, execute.enabled FROM command join execute on command.command_id = execute.command_id where execute.guild_id = '" . $_SESSION['guild_id'] . "'";
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

    public function updateEnabled($id, $new)
    {
        try {
            print  $_SESSION['guild_id'];
            session_start();
            $query = "update execute set enabled =:new where command_id =:id and guild_id =:guildid";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':new', $new);
            $resultset->bindValue(':id', $id);
            $resultset->bindValue(':guildid', $_SESSION['guild_id']);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    public function addCommand($name, $response)
    {
        try {
            print  $_SESSION['guild_id'];
            session_start();
            $query = "insert into command(name, response) values(:name, :response) and guild_id =:guildid";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':name', $name);
            $resultset->bindValue(':response', $response);
            $resultset->bindValue(':guildid', $_SESSION['guild_id']);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}

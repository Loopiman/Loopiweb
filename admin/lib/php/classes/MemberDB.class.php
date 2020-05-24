<?php

class MemberDB extends Guild
{

    private $_db;
    private $_array = array();


    public function __construct($db)
    { //contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getMember()
    {
        try {
            $this->_db->beginTransaction();
            $query = "select member.tag, join_guild.xp, member.avatar, max(role.position) as pos, join_guild.account_join
            from member join has_role on (member.member_id=has_role.member_id) join role on (has_role.role_id=role.role_id) join join_guild on member.member_id = join_guild.member_id where join_guild.guild_id = '" . $_SESSION['guild_id'] . "' and role.guild_id = '" . $_SESSION['guild_id'] . "'
            group by username order by pos desc";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $this->_db->commit();
            while ($data = $resultset->fetch()) {
                $_array[] = new Guild($data);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
            $_array = null;
        }
    }
    /*public function getMemberTag($tag)
    {
        try {
            $query = "select member.tag, join_guild.xp, member.avatar, max(role.position) as pos, join_guild.account_join
            from member join has_role on (member.member_id=has_role.member_id) join role on (has_role.role_id=role.role_id) join join_guild on member.member_id = join_guild.member_id where join_guild.guild_id = '" . $_SESSION['guild_id'] . "' and role.guild_id = '" . $_SESSION['guild_id'] . "'
            and member.tag like '%:tag%' group by username order by pos desc";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':tag', $tag);
            $resultset->execute();
            while ($data = $resultset->fetch()) {
                $_array[] = new Guild($data);
            }
            if (!empty($_array)) {
                return $_array;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
            $_array = null;
        }
    }*/
}

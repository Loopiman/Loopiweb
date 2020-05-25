<?php

session_start();
class VueMembers
{

    private $_db;
    private $_array = array();

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function getMemberTag($tag)
    {
        try {
            $query = "select member.tag, join_guild.xp, member.avatar, max(role.position) as pos, join_guild.account_join
            from member join has_role on (member.member_id=has_role.member_id) join role on (has_role.role_id=role.role_id) join join_guild on member.member_id = join_guild.member_id where join_guild.guild_id = '" . $_SESSION['guild_id'] . "' and role.guild_id = '" . $_SESSION['guild_id'] . "'
            and member.tag like '%" . $tag . "%' group by username order by pos desc, member.tag ";
            //, pos desc 
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            while ($data = $resultset->fetch()) {
                $_array[] = $data;
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
    public function getMemberTri($tri, $sort)
    {
        try {
            $query ="";
            if (strcmp($sort, "DESC")) {
                $query = "select member.tag, join_guild.xp, member.avatar, max(role.position) as pos, join_guild.account_join
                from member
                join has_role on (member.member_id=has_role.member_id)
                join role on (has_role.role_id=role.role_id)
                join join_guild on member.member_id = join_guild.member_id
                where join_guild.guild_id = '" . $_SESSION['guild_id'] . "'
                and role.guild_id = '" . $_SESSION['guild_id'] . "'
                group by username
                order by
                (case :tri when 'tag' then tag end) asc,
                (case :tri when 'account_join' then account_join end) asc  ,max(role.position) asc";
            }
            else{
                $query = "select member.tag, join_guild.xp, member.avatar, max(role.position) as pos, join_guild.account_join
                from member
                join has_role on (member.member_id=has_role.member_id)
                join role on (has_role.role_id=role.role_id)
                join join_guild on member.member_id = join_guild.member_id
                where join_guild.guild_id = '" . $_SESSION['guild_id'] . "'
                and role.guild_id = '" . $_SESSION['guild_id'] . "'
                group by username
                order by 
                (case :tri when 'tag' then tag end) desc,
                (case :tri when 'account_join' then account_join end) desc,max(role.position) desc,
                pos";
            }

            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':tri', $tri);
            $resultset->execute();
            while ($data = $resultset->fetch()) {
                $_array[] = $data;
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

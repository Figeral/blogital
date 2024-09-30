<?php
class BlogMember extends BlogReader
{

    private $username;
    public function __construct($pUsername)
    {
        parent::__construct();
        $this->username = $pUsername;
        $this->type = BlogReader::MEMBER;
        $this->db = Database::getInstance();
    }
    public function isDuplicateID(string $username)
    {

        $sql = "SELECT count(username) AS num FROM members WHERE
username = :username";
        $values = array(array(":username", $username));
        $result = $this->db->queryDB($values, $sql, $this->db::SELECTSINGLE);
        return count($result) > 0 || $result["count"]  ? true : false;
    }

    public function insertIntoMemberDB($pPassword)
    {
        $sql = "INSERT INTO members (username, password) VALUES
(:username, :password)";
        $values = array(array(":username", $this->username), array(":password", password_hash($pPassword, PASSWORD_DEFAULT)));
        try {
            $this->db->queryDB($values, $sql, Database::EXECUTE);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function isValidLogin($pPassword)
    {
        $sql = "SELECT password FROM members WHERE username = :username";
        $values = array(array(":username", $this->username));
        $result = $this->db->queryDB($values, $sql, Database::getInstance()::SELECTSINGLE);
        if (isset($result["password"]) && $pPassword == $result['password']) {
            return true;
        } else {
            return false;
        }
    }
    private function getLatestPostID()
    {
        $sql = "SELECT max(id) AS max FROM posts";
        $result = $this->db->queryDB(null, $sql, Database::getInstance()::SELECTSINGLE);

        return   isset($result["max"]) ? $result["max"] : 0; // returns null if there isn't no post found 
    }
    public function updateLastViewedPost()
    {
        $max = $this->getLatestPostID();
        $sql = "UPDATE members SET last_viewed = :max WHERE username
= :username";
        $values = array(array(":max", $max), array(":username", $this->username));
        try {
            $this->db->queryDB($values, $sql);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getLastViewedPost()
    {
        $sql = "SELECT last_viewed FROM members WHERE username =
:username";
        $values = array(array(":username", $this->username));
        $result = $this->db->queryDB($values, $sql);
        return isset($result['last_viewed']) ? $result['last_viewed'] : 0;
    }
}

<?php
class Admin
{
    private $username;
    private $db;
    public function __construct($pUsername)
    {
        $this->username = $pUsername;
        $this->db = Database::getInstance();
    }
    public function isValidLogin($pPassword)
    {
        $sql = "SELECT password FROM members WHERE username =
:username AND is_admin = true";
        $values = array(array(":username", $this->username));
        $result = $this->db->queryDB($values, $sql);
        return isset($result) ? true : false;
    }
    public function insertPostIntoDB($title, $post, $audience)
    {
        $sql = "INSERT INTO posts (username, title, post, audience)
VALUES (:username, :title, :post, :audience)";
        $values = array(array(":title", $title), array(":post", $post), array(":audience", $audience));
        try {
            $this->db->queryDB($values, $sql, Database::getInstance()::EXECUTE);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

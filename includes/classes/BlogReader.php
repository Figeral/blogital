<?php

class BlogReader
{

    const READER = 1;
    const MEMBER = 2;

    protected $db;
    protected $type;

    public function __construct()
    {

        $this->db = Database::getInstance();
        $this->type = BlogReader::READER;
    }
    public function getPostFromDB()
    {
        $sql =
            "SELECT id, unix_timestamp(post_date) as
       `post_date`, username, title, post, audience FROM
        posts WHERE audience <= :audience ORDER BY id DESC";
        $values = array(array(":audience", $this->type));
        try {
            $result = $this->db->queryDB($values, $sql, Database::getInstance()::SELECTALL);
            if (count($result) > 0) {
                return $result;
            } else {
                return array();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

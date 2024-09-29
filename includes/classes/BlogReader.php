<?php

class BlogReader
{

    const READER = 1;
    const MEMBER = 2;

    protected $db;
    protected $type;

    public function __construct()
    {

        $this->db = new Database();
        $this->type = BlogReader::READER;
    }
    public function getPostFromDB() {}
}

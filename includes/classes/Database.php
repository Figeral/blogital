<?php

class Database
{

    const SELECTSINGLE = 1;
    const SELECTALL = 2;
    const EXECUTE = 3; // here this property will help our class queryDB know when we want to do other operation than selection.

    private $pdo;
    private static $instance = null;

    private function __construct()
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=php1", "fitzgerard", "Diablomanore237@localhost");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setAttribute method is to set given prop 
        //Here we are changing the default pdo error mode to ERRMODE_Exception in other to get possible runtime error
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            return self::$instance = new self();
        } else {
            return self::$instance;
        }
    }
    public function getConnection()
    {
        return self::$pdo;
    }
    public function queryDB(null|array $values, $query,  $mode = 1)
    {
        //where $values is a multidimensional array containing each param and value  to bind
        // and initializing the default mode to 1 meaning fetch type lazy . ie fetching with key integer index or words

        $stmt = $this->pdo->prepare($query);
        if (isset($values) && $values != null) {
            foreach ($values as $valueToBind) {
                $stmt->bindValue($valueToBind[0], $valueToBind[1]);
            };
        }

        $stmt->execute();


        //  from doc
        //    fetch -> returns the next row of the result set 
        //    fetchAll-> returns all the result set as an array


        // here we will instead use the @param $mode to determine to fetching option either single or all 

        if ($mode != self::SELECTSINGLE && $mode != self::SELECTALL && $mode != self::EXECUTE) {
            throw new Exception("Selection mode undefined , counld not proceed the query");
        } elseif ($mode === self::SELECTSINGLE) {
            return  array($stmt->fetch(PDO::FETCH_LAZY));
        } elseif ($mode === self::SELECTALL) {
            return (array)$stmt->fetchAll(PDO::FETCH_LAZY);
        }
    }
}

<?php

class database
{
    private $dbName;
    public $dbh = false;

    function __construct($dbName)
    {
        $this->dbName = $dbName;
    }

    function connectDb()
    {
        $db_driver="mysql"; $host = "localhost"; $database = $this->dbName;
        $dsn = "$db_driver:host=$host; dbname=$database";

        $username = "root"; $password = "root";
        $options = array(PDO::ATTR_PERSISTENT => true, PDO::
        MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try
        {
            $dbh = new PDO ($dsn, $username, $password, $options);
        }
        catch (PDOException $e)
        {
            throw new Exception( $e->getMessage());
            die();
        }
        $this->dbh = $dbh;
    }
}

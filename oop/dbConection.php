<?
    class database
    {
        private $dbName;

        function __construct($dbName)
        {
            $this->dbName = $dbName;
        }

        function conectDb()
        {
            $db_driver="mysql"; $host = "localhost"; $database = $this->dbName ;
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
                echo "Error!: " . $e->getMessage() . "<br/>"; die();
            }
            return $dbh;
        }
    }
?>
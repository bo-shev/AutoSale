<?
    include_once 'dbConection.php';

    class saveCode
    {
        private $dbh;

        function __construct()
        {
            $this->dbh = new database('backup');
        }

        function saveSource($fileName, $source)
        {
            $dbh = $dbh.conectDb();

            if(codeExist($fileName))
            {
                $sql = "UPDATE source_code SET code = '$source' WHERE source_code.name = '$fileName'"; 
            }
            else
            {
                $sql = "INSERT INTO `source_code` (`name`, `code`) VALUES ('$fileName','$source')";
            }
            $dbh->query($sql);
        }

        function codeExist($fileName)
        {
            $dbh = $dbh.conectDb();

            $sql = "SELECT * FROM `source_code` WHERE source_code.name ='$fileName'";

            $cheak = $dbh->query($sql);
            if(current($cheak)!=null)
            {
                return true;
            }
            else return false;
        }
    }
?>
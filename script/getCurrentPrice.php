<?
    function getCurrentPrice($id_car)
    {
        include_once 'conect.php';
        $dbh = conectDb('car');
        $sql =  "SELECT * FROM `auction_lot` WHERE auction_lot.fid_car='$id_car'";
            foreach($dbh->query($sql) as $row)
            {               
               echo $row["current_price"];
                break;
            }
    }
    if(array_key_exists('id_car',$_GET))
    {
        getCurrentPrice( $_GET['id_car']); 
    }

?>
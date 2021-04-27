<?
    include_once 'conect.php';
   
    $dbh = conectDb('car');
$zero = 0;
    $sql =  "SELECT * FROM `auction_lot` WHERE auction_lot.fid_car='".$_GET['id_car']."'";//
    foreach($dbh->query($sql) as $row)
    { //$_POST['bet'] 50

        $newPrice = (integer)$row['current_price']+(integer)$_GET['beeet'];
       
        
       // echo $row['id'];
        $sql = "UPDATE auction_winer SET auction_winer.fid_user=".(integer)$_GET['user_id'].", auction_winer.bet=".(integer)$_GET['beeet']." WHERE auction_winer.fid_lot='".$row['id']."'";////
        $dbh->query($sql);
        $sql = "UPDATE auction_lot SET current_price=".(integer)$newPrice."  WHERE auction_lot.fid_car='".(integer)$_GET['id_car']."'";//
        $dbh->query($sql);
        break;
    }

?>
<?
    
    function insertCar($id_car, $db_type)
    {
        $time_end = strtotime($_POST['auctionend']);
              
        include_once 'conect.php';
        $dbh = conectDb('car');

        if($db_type == 0)
        {                
            $sql ='(SELECT (MAX(auction_car.id_car)+1) as id FROM auction_car)';
            $new_id_car = -1;
            foreach ($dbh->query($sql) as $row) 
            {        
                $new_id_car = $row['id'];
                //break;
            }
                        
            $sql = "SELECT * FROM `car` WHERE `car`.`id_car`='$id_car'";
            foreach ($dbh->query($sql) as $row) 
            {
                $sql = 
                "
                INSERT INTO `auction_car` (`id_car`, `brand`, `price`, `horse_power`, `volume`, `fuel`, `distance`, `car_condition`, `description`, `model`, `year`) 
                VALUES ('$new_id_car', '".$row['brand']."', '".$row['price']."', '".$row['horse_power']."', '".$row['volume']."', '".$row['fuel']."', '".$row['distance']."', '".$row['car_condition']."', '".$row['description']."', '".$row['model']."', '".$row['year']."')";
                $dbh->query($sql);
                break;
            }

            $sql = "SELECT * FROM `photos`  WHERE `photos`.`fid_car`='$id_car'";
            foreach ($dbh->query($sql) as $row) 
            {
                $sql = "INSERT INTO auction_photos (fid_car , pach_poto) VALUES ('".$new_id_car."','".$row['pach_poto']."')";
                $dbh->query($sql);
            }
               
            $sql = "INSERT INTO auction_lot (`fid_car`, `time_end`, `top_price`, `current_price`, `minimal_bet`) VALUES ('".$new_id_car."','".$time_end."','".$_POST['top_price']."','".$_POST['start_price']."','".$_POST['minimal_bet']."')";
            $dbh->query($sql);

            $sql = "SELECT (MAX(auction_lot.id)) as id_lot FROM auction_lot";
            foreach ($dbh->query($sql) as $row) 
            {        
                $id_lot = $row['id'];
                break;
            }

            $sql = "INSERT INTO `auction_winer` (`fid_lot`, `fid_car`, `fid_user`, `bet`) VALUES ('".$id_lot."', '".$new_id_car."', '0', '0');";
            $dbh->query($sql);

            include_once 'delCar.php';
            deleteCar($id_car, $db_type);

       }      
        
    }



    if(array_key_exists('confirm',$_POST))
    {
        insertCar( $_POST['id_car'], $_POST['dbtype']); 
    }
  
?>



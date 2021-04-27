<?
    
    function confirmCar($id_car, $db_type)
    {
        include_once 'conect.php';
        $dbh = conectDb('car');

        if($db_type == 1)
        {                
            $sql ='(SELECT (MAX(car.id_car)+1) as id FROM car)';
            $new_id_car = -1;
            foreach ($dbh->query($sql) as $row) 
            {        
                $new_id_car = $row['id'];
                //break;
            }
                        
            $sql = "SELECT * FROM `users_car` WHERE `users_car`.`id_car`='$id_car'";
            foreach ($dbh->query($sql) as $row) 
            {
                $sql = 
                "
                INSERT INTO `car` (`id_car`, `brand`, `price`, `horse_power`, `volume`, `fuel`, `distance`, `car_condition`, `description`, `model`, `year`) 
                VALUES ('$new_id_car', '".$row['brand']."', '".$row['price']."', '".$row['horse_power']."', '".$row['volume']."', '".$row['fuel']."', '".$row['distance']."', '".$row['car_condition']."', '".$row['description']."', '".$row['model']."', '".$row['year']."')";
                $dbh->query($sql);
                break;
            }

            $sql = "SELECT * FROM `users_photos`  WHERE `users_photos`.`fid_car`='$id_car'";
            foreach ($dbh->query($sql) as $row) 
            {
                $sql = "INSERT INTO photos (fid_car , pach_poto) VALUES ('".$new_id_car."','".$row['pach_poto']."')";
                $dbh->query($sql);
            }

            include_once 'delCar.php';
            deleteCar($id_car, $db_type);

        }      
        
    }



    if(array_key_exists('confirm',$_POST))
    {
        confirmCar( $_POST['idcar'], $_POST['dbtype']); 
    }
   // include_once 'siteparts/siteHeader.php';
?>



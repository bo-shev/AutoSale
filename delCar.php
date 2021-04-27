<?

    function deleteCar($id_car, $db_type)
    {
        include_once 'conect.php';
        $dbh = conectDb('car');

        if($db_type == 1)
        {                
            
                        
            $sql = "DELETE FROM `car_owner` WHERE `car_owner`.`fk_users_car_id` ='$id_car'";
            $dbh->query($sql);
            
            $sql = "DELETE FROM `users_photos` WHERE `users_photos`.`fid_car` = '$id_car'";
            $dbh->query($sql);
            
            $sql = "DELETE FROM `users_car` WHERE `users_car`.`id_car`='$id_car'";
            $dbh->query($sql);

            echo $id_car;
        }
        else
        {   
                                    
            $sql = "DELETE FROM `photos` WHERE `photos`.`fid_car` = '$id_car'";
            $dbh->query($sql);
                         
            $sql = "DELETE FROM `car` WHERE `car`.`id_car` = '$id_car'";
            $dbh->query($sql);
            
        }
        
    }



    if(array_key_exists('delete',$_POST))
    {
        deleteCar( $_POST['idcar'], $_POST['dbtype']); 
    }
    include_once 'siteparts/siteHeader.php';
?>
<div class="contentSearchPage regandlog" style=" height:90vh"><br><br><br>
    Операція пройшла успішно
</div>

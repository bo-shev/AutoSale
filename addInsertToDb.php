
<?

function addCarPhoto( $pach)//$id_car,
{    
    error_reporting(-1);

    include_once 'conect.php';

     $dbh = conectDb('car');

    

    //подготовленный запрос
    $smth=$dbh->prepare("INSERT INTO users_photos (fid_car , pach_poto) VALUES ((SELECT MAX(users_car.id_car) FROM users_car),:pach_poto)");
   
  //$smth->bindParam(':fid_car',$id_car);
    $smth->bindParam(':pach_poto',$pach);

    //$smth=$dbh->prepare("INSERT INTO photos (fid_car,pach_poto) VALUES (\'0\',\'F:\\Programs\\OpenServer\\domains\\Salo0n/upload/eca9459e65c9c9df4cf7ade812e4e332.jpg\')");
    $smth->execute();
    $dbh = null;
}

function addCarInfo($brand, $price, $horse_power, $volume, $fuel, $distance, $car_condition, $description, $model, $year)
{
    error_reporting(-1);
    include_once 'conect.php';

    
    $dbh = conectDb('car');


    $sql ='(SELECT (MAX(users_car.id_car)+1) as id FROM users_car)';
    $id_car = -1;
    foreach ($dbh->query($sql) as $row) 
    {        
        $id_car = $row['id'];
        //break;
    }
    
    
    $smth=$dbh->prepare("INSERT INTO `users_car` (`id_car`, `brand`, `price`, `horse_power`, `volume`, `fuel`, `distance`, `car_condition`, `description`, `model`, `year`) VALUES (('$id_car'), '$brand', '$price', '$horse_power', '$volume', '$fuel', '$distance', '$car_condition', '$description', '$model', '$year')");
    
  
    
    $smth->execute();
    addCarOwner($id_car);
    $dbh = null;

    
}

function addCarOwner($id_car)
{  
    include_once 'siteParts/usercheck.php';
    $user = checkUser();
    include_once 'conect.php';
    $dbh = conectDb('car');


    $user = $user['user_id'];//$userdata['user_id']
    $smth=$dbh->prepare("INSERT INTO car_owner (user_id, fk_users_car_id) VALUES ('$user', '$id_car')");
    
   // echo $id_car;

   // echo $user;
    $smth->execute();
    $dbh = null;
}

//addCarOwner(0);
?>
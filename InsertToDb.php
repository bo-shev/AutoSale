
<?

function addCarPhoto( $pach)//$id_car,
{    
    error_reporting(-1);

    include_once 'conect.php';

     $dbh = conectDb('car');

    

    //подготовленный запрос
    $smth=$dbh->prepare("INSERT INTO photos (fid_car , pach_poto) VALUES ((SELECT MAX(car.id_car) FROM car),:pach_poto)");
   
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


    $sql ='(SELECT (MAX(car.id_car)+1) as id FROM car)';
    $id_car = -1;
    foreach ($dbh->query($sql) as $row) 
    {        
        $id_car = $row['id'];
        //break;
    }
    
    //echo $id_car;
    $smth=$dbh->prepare("INSERT INTO `car` (`id_car`, `brand`, `price`, `horse_power`, `volume`, `fuel`, `distance`, `car_condition`, `description`, `model`, `year`) VALUES (('$id_car'), '$brand', '$price', '$horse_power', '$volume', '$fuel', '$distance', '$car_condition', '$description', '$model', '$year')");
    
  
    
    $smth->execute();
    $dbh = null;
}
?>
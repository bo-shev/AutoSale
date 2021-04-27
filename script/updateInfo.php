<?

include_once 'conect.php';
$dbh = conectDb('car');

if($_GET['dbtype'] == 1)
{
    
$sql = "UPDATE users_car SET brand = '".$_GET['brand']."',  price = '".$_GET['price']."', horse_power = '".$_GET['hp']."', volume = '".$_GET['volume']."' ,
 fuel = '".$_GET['fuel']."', distance = '".$_GET['distance']."', car_condition = '".$_GET['carcondition']."',  users_car.description = '".$_GET['description']."' , model = '".$_GET['model']."'  , year = '".$_GET['year']."' WHERE users_car.id_car='".$_GET['idcar']."'"; 
}
else
 {
    $sql = "UPDATE car SET brand = '".$_GET['brand']."',  price = '".$_GET['price']."', horse_power = '".$_GET['hp']."', volume = '".$_GET['volume']."' ,
 fuel = '".$_GET['fuel']."', distance = '".$_GET['distance']."', car_condition = '".$_GET['carcondition']."',  description = '".$_GET['description']."' , model = '".$_GET['model']."'  , year = '".$_GET['year']."' WHERE id_car='".$_GET['idcar']."'"; 


 }
$dbh->query($sql);
echo "Iнформацію оновлено успішно!";

?>
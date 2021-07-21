<?php
include_once "../HtmlParts/siteHeader.php";

if ($user_info['role'] == "admin")
{
echo  '<br><br><br><div class="contentSearchPage regandlog changecarinfoclass" style = "min-height: 90%;"> <br><br><br>';
echo ' <div style=" float: left;">';
include '../Views/galery.php';
echo '</div>';

if ($carInfo['brand'] == null)
{
    echo "Автомобіль видалено або не існує";
}
echo ' <form  method="Post" enctype="multipart/form-data">

    <input name="idcar" type="hidden" value='.$_GET['car_id'].'>
       
     <table border="0" class="changecarinfotable">
   
     <tr><td>Бренд</td> <td> <input type="text" name="brand" value='.$carInfo['brand'].'><td></tr>
     <tr><td>Модель</td> <td> <input type="text" name="model" value='.$carInfo['model'].'><td></tr>
     <tr><td>Ціна</td> <td><input type="number" name="price" value='.$carInfo['price'].'><td></tr>
     <tr><td>Рік</td> <td><input type="number" name="year" value='.$carInfo['year'].'><td></tr>
     <tr><td>Потужність</td> <td><input type="number" name="hp" value='.$carInfo['horsePower'].'><td></tr>
     <tr><td>Об`єм</td> <td><input type="number" name="volume"  min="0" max="100" step="0.01" value='.$carInfo['volume'].'><td></tr>
   
     <tr><td>Пробіг</td> <td><input type="number" name="distance" value='.$carInfo['carMileage'].'><td></tr>';

echo '
<tr><td>Тип пального</td> <td><select  name="fuel">
     <option ';
if($carInfo['fuel'] == 'fuelType'){echo("selected");}
echo' value="petrol">Бензин</option> 
     <option '; if($carInfo['fuelType'] == 'diesel'){echo("selected");}
echo' value="diesel">Дизель</option>
     <option '; if($carInfo['fuelType'] == 'electric'){echo("selected");}
echo' value="electric">Електро</option>
     </select><td></tr>
   
     <tr><td>Опис</td> <td><textarea name="description"  >'.$carInfo['description'].'</textarea><td></tr>  
   
     </table>';

echo  '<input type="submit" action="../Controllers/ChangeCarInfoController.php"  name="change" method="POST" value="Підтвердити" ">
     <span id="confirmed"></span>
   </form>';

echo '<form name="deleteForm" method="post">';
echo ' <input name="idcar" type="hidden" value='.$_GET['car_id'].'>';

echo '<input type="Submit" name="delete" value=" Видалити цей об`єкт">';
echo '</form>';
    echo '<form name="moveToAuction" action="../Controllers/AuctionController.php" method="post">';
    echo ' <input name="idcar" type="hidden" value='.$_GET['car_id'].'>';
    echo '<input type="Submit" name="moveToAuction" value="Винести авто на аукціон">';
    echo '</form>';


    echo '</div>';


}
include_once "../HtmlParts/footer.php";
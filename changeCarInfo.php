<?
      //include_once 'siteparts/adminonly.php';
       include_once 'siteParts/usercheck.php';
       $user = checkUser();
   
       if ($user == false || $user['role'] == 'user')
       {
       header('Location: http://salo0n/login.php');
       }
       include_once 'siteparts/siteHeader.php';
   
       function outChanherPanel($id_car, $db_type) // 0-авто салона 1-авто від користувачів 
       {
       echo '<script src="script/script.js"></script>
   <div class="contentSearchPage regandlog" style=" height:90vh"> <br><br><br>';

   
   include_once 'conect.php';
   $dbh = conectDb('car');
       if($db_type == 1)
       {
        $sql = "SELECT * FROM `users_car` WHERE users_car.id_car=$id_car"; //$id_car
        
        include_once 'userCarGalery.php';
       }
       else 
       {
           $sql = "SELECT * FROM `car` WHERE car.id_car=$id_car"; 
            
          include_once 'galery.php';  
       }
   echo ' <div style=" float: left;">';
   createGallery($id_car);
   echo '</div>';
   
   foreach ($dbh->query($sql) as $row) 
   {   
   

    echo ' <form  method="get" enctype="multipart/form-data">

    <input id="idcar" type="hidden" value='.$id_car.'>
    <input id="dbtype" type="hidden" value='.$db_type.'>
   
     <table border="0" >
   
     <tr><td>Бренд</td> <td> <input type="text" id="brand" value='.$row['brand'].'><td></tr>
     <tr><td>Модель</td> <td> <input type="text" id="model" value='.$row['model'].'><td></tr>
     <tr><td>Ціна</td> <td><input type="number" id="price" value='.$row['price'].'><td></tr>
     <tr><td>Рік</td> <td><input type="number" id="year" value='.$row['year'].'><td></tr>
     <tr><td>Потужність</td> <td><input type="number" id="hp" value='.$row['horse_power'].'><td></tr>
     <tr><td>Об`єм</td> <td><input type="number" id="volume"  min="0" max="100" step="0.01" value='.$row['volume'].'><td></tr>
   
     <tr><td>Пробіг</td> <td><input type="number" id="distance" value='.$row['distance'].'><td></tr>';
    
   echo " <tr><td>Стан</td> <td><select id='carcondition' >";
     echo '
     <option '; if($row['car_condition'] == 'used'){echo("selected");}
     echo' value="used">Б\У</option> 
     <option '; if($row['car_condition'] == 'new'){echo("selected");}
     echo' value="new">Нова</option>
     </select><td></tr>
   
     
     <tr><td>Тип пального</td> <td><select  id="fuel">
     <option ';
      if($row['fuel'] == 'petrol'){echo("selected");}
      echo' value="petrol">Бензин</option> 
     <option '; if($row['fuel'] == 'diesel'){echo("selected");}
     echo' value="diesel">Дизель</option>
     <option '; if($row['fuel'] == 'electric'){echo("selected");}
     echo' value="electric">Електро</option>
     </select><td></tr>
   
     <tr><td>Опис</td> <td><textarea id="description"  >'.$row['description'].'</textarea><td></tr>
     <!-- <input type="text" id="description" > -->
   
     </table>
     <input type="button" name="form1submit" value="Підтвердити" onclick="changeInfo();">
     <span id="confirmed"></span>
   </form>';

   echo '<form name="deleteForm" action="delCar.php" method="post">';
    echo '<input name="idcar" type="hidden" value='.$id_car.'>';
    echo '<input name="dbtype" type="hidden" value='.$db_type.'>';
    echo '<input type="Submit" name=delete value=" Видалити цей об`єкт">';
    echo '</form>';
   
    if($db_type==1)
    {
      echo '<form name="confirmForm" action="ConfirmCar.php" method="post">';
      echo '<input name="idcar" type="hidden" value='.$id_car.'>';
      echo '<input name="dbtype" type="hidden" value='.$db_type.'>';
      echo '<input type="Submit" name=confirm value=" Перенести цей об`єкт до головної БД">';
      echo '</form>';

    }
    else if($db_type==0)
    {
      echo '<form name="auctionForm" action="auctionMoveCar.php" method="post">';
      echo '<input name="idcar" type="hidden" value='.$id_car.'>';
      echo '<input name="dbtype" type="hidden" value='.$db_type.'>';
      echo '<input type="Submit" name=confirm value=" Винести цей автомобіль на аукціон ">';
      echo '</form>';

    }
          
    echo '</div>';
  }

       }
 
 
       if(array_key_exists('id_car',$_POST))
      {
        outChanherPanel( $_POST['id_car'], $_POST['db_type']); 
      }    

     //  outChanherPanel(0, 1);
?>

<?
function previewCar($id_car)
{
    
echo '
    
<form class="search_result" name="myform'.$id_car.'" action="vievcar.php" method="post">
    <input type="hidden" name="test" value='.$id_car.' />
    <a href="javascript: submitMy('.$id_car.')">

    <div class="column">
';



//include_once 'vievcar.php' ;
echo' 



    <div class="card">
    ';
     include_once 'conect.php';

     $dbh = conectDb('car');

     $sql = "SELECT pach_poto FROM photos WHERE fid_car = '$id_car'";//$id_car

     foreach($dbh->query($sql) as $row)
         {
            echo '<img src='.$row["pach_poto"].' alt="Car" style="width:98%;margin-top:6px">';
            break;
         }
 

         $sql = "SELECT * FROM car WHERE car.id_car = '$id_car'"; //$id_car

         echo '<div class="container">';
         foreach($dbh->query($sql) as $row)
         {
             echo '<span class="carName">'.$row["brand"].' '.$row["model"].' </span>';
             echo '<span class="price">$'.$row["price"].'</span>';
            //  style ="width:200px
             $carInfoTable = '<div class="carInfo">
             <table>
                 <tr>
                     <td>Пробіг:</td>
                     <td>'.$row["distance"].'км</td>
                     <td>Стан:</td>
                     <td>'.$row["car_condition"].'</td>
                 </tr>
                 <tr>
                     <td>Рік:</td>
                     <td>'.$row["year"].'</td>
                     <td>Тип палива:</td>
                     <td>'.$row["fuel"].'</td>
                 </tr>
                 <tr>
                     <td>Об*єм двигуна:</td>
                     <td>'.$row["volume"].' л</td>
                     <td>Потужність:</td>
                     <td>'.$row["horse_power"].' кс</td>
                 </tr>
             </table>
         </div>';

         } 
    $dbh = null;
    
      echo '     
      
    
       
      </div>
    </div></a> 
   
  </div>'.$carInfoTable.'
  <script type="text/javascript">
  function submitMy(formNumb)
  {
      document.forms["myform"+formNumb].submit(); 
  }</script>
   </form> 
  ';
        }
  ?>
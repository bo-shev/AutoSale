<?
include_once 'siteParts/usercheck.php';
$user = checkUser();

if ($user == false)
{
   header('Location: http://salo0n/login.php');
}

function carInfo($id_car)
{    
    include_once 'conect.php';
    $dbh = conectDb('car');

    $sql = "SELECT brand, model, price, year FROM car WHERE car.id_car = '$id_car'";
    foreach($dbh->query($sql) as $row)
        {
            return $row['brand'].' '.$row['model'].' '.$row['price'].'$ '.$row['year'].'p';
        }
        $dbh = null;
}

function viewUser($user_id)
{
   
   // echo $user_id.'<br>';
    $dbh = conectDb('users');

    $sql = "SELECT * FROM users WHERE users.user_id = '$user_id'"; 

    foreach($dbh->query($sql) as $row)
    {
        echo '<span>Інформація про користувача:</span>';
            echo '<table border="0" ><tr><td>Логін користувача:</td><td>'.$row["user_login"].'</td></tr>';
            echo '<tr><td>Пошта:</td><td>'.$row["user_mail"].'</td></tr>';
            echo '<tr><td>Телефонний номер:</td><td>'.$row["user_number"].'</td></tr>';
            echo '<tr><td>Індифікатор користувача:</td><td>'.$row["user_id"].'</td></tr>';
            echo '<tr><td>Роль користувача:</td><td>'.$row["role"].'</td></tr>';
           
            echo '</table>';
    }
    $dbh = null;
}

function orderPreview()
{
    include_once 'conect.php';
        
        $dbh = conectDb('users');

        $sql = "SELECT * FROM orders"; 
      
       
        foreach($dbh->query($sql) as $row)
        {
            echo '<div class="search_result regandlog"  >';
            $infCar = carInfo($row["car_id"]);
            echo $infCar.'<br>Номер замовлення: '.$row["order_id"].'<br>'; 
            viewUser($row["user_id"]);
            
            echo '<a href="javascript: submitMy('.$row["order_id"].')" class="button right">Видалити замовлення</a>';
            echo ' </div><br>';
             
            echo '<form class="search_result" name="form'.$row["order_id"].'" action="orderDel.php" method="post">';
            echo '<input type="hidden" name="order_id" value='.$row["order_id"].' />';
            echo '</form>';
        }
        
   
}

include_once 'siteparts/siteHeader.php';
echo '<div class="contentSearchPage "><br><br><br>';
orderPreview();

?>

<script type="text/javascript">
  function submitMy(formNumb)
  {
      document.forms["form"+formNumb].submit(); 
  }</script>
  </div>;
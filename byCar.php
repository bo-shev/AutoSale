<?
include_once 'siteParts/usercheck.php';
$user = checkUser();

if ($user == false)
{
   header('Location: http://salo0n/login.php');
}

function addCarOrder($id_car, $user_id)
{
   include_once 'conect.php';
   $dbh = conectDb('users');
  
   $smth=$dbh->prepare("INSERT INTO orders (user_id , car_id) VALUES ('$user_id','$id_car')");
   $smth->execute();
    $dbh = null;
}



if(array_key_exists('id_car',$_POST))
{
     $_POST['id_car'];
      global $user;
     addCarOrder( $_POST['id_car'], $user['user_id']);
 }

 include_once 'siteParts/siteHeader.php';
?>
<div class="contentSearchPage regandlog"><br><br><br>

   <span>Дякуємо за ваше замовлення! Наш менеджер скоро зв'яжеться з вами.</span>
</div>
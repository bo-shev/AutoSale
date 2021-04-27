<?
include_once 'siteParts/usercheck.php';
$user = checkUser();

if ($user == false)
{
   header('Location: http://salo0n/login.php');
}
else
{
    echo '<div class="contentSearchPage regandlog"><br><br><br><br><br><br>';
    switch ($user['role'])
     {
        case 'user':
           echo '<a href="http://salo0n/addUserCar.php" class = "button">Продати авто</a>'; //
           echo '<a href="http://salo0n/carsPage.php" class = "button">Пошук автомобіля</a>';
            break;
        case 'moder':
          echo '<a href="http://salo0n/usersCarPage.php" class = "button">Переглянути заявки</a>';
          echo '<a href="http://salo0n/orders.php" class = "button">Переглянути замовлення</a>';  
             break;
       case 'admin':
          echo '<a href="http://salo0n/usersPage.php" class = "button">Список користувачів</a>'; 
          echo '<a href="http://salo0n/orders.php" class = "button">Переглянути замовлення</a>'; 
          echo '<a href="http://salo0n/uploadFoto.php" class = "button">Додати авто</a>'; 
             break;
     }
    echo '</div>';
}
include_once 'siteParts/siteHeader.php';

?>
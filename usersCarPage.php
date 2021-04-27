<?
     include_once 'siteParts/usercheck.php';
     $user = checkUser();
 
     if ($user == false || $user['role'] == 'user')
     {
        header('Location: http://salo0n/login.php');
     }

     include_once 'userCarPreview.php';
     include_once 'siteparts/siteHeader.php';

     echo '<div class="contentSearchPage "><br><br><br>';


     
    include_once 'conect.php';        
    $dbh = conectDb('car');
    $sql = "SELECT * FROM `users_car`"; 
  
   
    foreach($dbh->query($sql) as $row)
    {
     

     previewUserCar($row['id_car']);

    }



     echo '</div>';
?>
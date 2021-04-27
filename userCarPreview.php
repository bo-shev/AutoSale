<?
    function previewUserCar($id_car)
    {    
        include_once 'conect.php';
        $dbh = conectDb('car');

        $sql = "SELECT * FROM `users_photos` WHERE users_photos.fid_car=$id_car"; //$id_car
             
        echo '<div class="search_result regandlog"  >';
        
        //<img src="images/girl.png"   width="100" height="100" alt="user_car_photo">
        foreach ($dbh->query($sql) as $row) 
        {
            echo '<img style= "float:left; margin:10px" src="'.$row['pach_poto'].'"   width="180" height="130" alt="user_car_photo">';
            break;
        } 
      

       

        $sql = "SELECT * FROM `car_owner` WHERE car_owner.fk_users_car_id =$id_car";

        foreach ($dbh->query($sql) as $row) 
        {
            $sql = "SELECT * FROM users WHERE users.user_id = ".$row['user_id'].""; 
            break;
        } 
       

        $dbh = conectDb('users');

       
       
        foreach($dbh->query($sql) as $row)
        {
            echo '<span>Інформація про користувача:</span>';
                echo '<table class="regandlog"  border="0" ><tr><td>Логін користувача:</td><td>'.$row["user_login"].'</td></tr>';
                echo '<tr><td>Пошта:</td><td>'.$row["user_mail"].'</td></tr>';
                echo '<tr><td>Телефонний номер:</td><td>'.$row["user_number"].'</td></tr>';
                echo '<tr><td>Індифікатор користувача:</td><td>'.$row["user_id"].'</td></tr>';
                echo '<tr><td>Роль користувача:</td><td>'.$row["role"].'</td></tr>';
            
                echo '</table>';
        }
        
    
        $dbh = null;


        echo '<a href="javascript: submitMy('.$id_car.')" class="button right">Редагування та  керування заявою</a>';
        echo '<form name="form'.$id_car.'" action="changeCarInfo.php" method="post">';
        echo '<input type="hidden" name="id_car" value='.$id_car.' />';
        echo '<input type="hidden" name="db_type" value=1 />';//1- авто від користувачів
        echo '</form>';
        echo '</div>';
       
    }
   // previewUserCar(0);
?>
<script type="text/javascript">
  function submitMy(formNumb)
  {
      document.forms["form"+formNumb].submit(); 
  }</script>
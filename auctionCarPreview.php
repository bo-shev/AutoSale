<?

    function previewAuctionCar($id_car)
    {    
        include_once 'conect.php';
        $dbh = conectDb('car');

        $sql = "SELECT * FROM `auction_photos` WHERE auction_photos.fid_car=$id_car"; //$id_car
             
       
      
        echo '<div class="search_result regandlog" style="height: 200px;margin: 10px;"  >';
        echo '<table class=" regandlog"><tr>';
        
        
        echo '<td>';
        foreach ($dbh->query($sql) as $row) 
        {
            echo '<img style= "float:left; margin:10px; display:block" src="'.$row['pach_poto'].'"   height="160"  alt="auction_car_photo">';
            break;
        } 
        echo '</td>';

        $sql = "SELECT * FROM `auction_winer` WHERE auction_winer.fid_car =$id_car";
        echo '<td>';
        foreach ($dbh->query($sql) as $row) 
        {
            if ($row['fid_user'] == 0)
                {
                    echo "<br><span>Лідерів аукціону поки що немає</span><br>";
                }
                else
                {
                    echo '<span><br>Лідер аукціону </span> <br> <table class="regandlog"  border="0" >';
                    echo '<tr><td>Користувач збільшив ставку на:</td><td>'.$row["bet"].'$</td></tr>';
                    $dbh = conectDb('users');
                    $sql = "SELECT * FROM users WHERE users.user_id = ".$row['fid_user'].""; 
                    foreach($dbh->query($sql) as $row)
                     {
                        echo '<tr><td>Логін лідера аукціону:</td><td>'.$row["user_login"].'</td></tr>';
                        break;
                     }
                    
                    echo '</table><br>';
                }

            
            break;
        } 
       
        $dbh = conectDb('car');
        $sql ="SELECT * FROM `auction_lot` WHERE auction_lot.fid_car='$id_car'";
        foreach($dbh->query($sql) as $row)
        {
            $date = new DateTime();
            $date->setTimestamp($row['time_end']);
            echo '<table class=" regandlog"><tr><td><span>Дата закінчення аукціону</span></td></tr>';
            echo '<tr><td><span>'.$date->format('F j, Y, H:i:s').'</span></td></tr>';
             
            echo '</table>';
        }
        echo '</td>';

    
        $dbh = null;

        echo '<td>';
        echo '<a href="javascript: submitMy('.$id_car.')"  style="position:relative; top:10px"  class="button right">Переглянути лот</a> ';

        echo '<a href="javascript: submitMy('.$id_car.')" class="button right" style="position:relative; top:30px" >Редагувати інформацію</a>';
        echo '<form name="form'.$id_car.'" action="auctionCarView.php" method="post">';
        echo '<input type="hidden" name="id_car" value='.$id_car.' />';
        echo '<input type="hidden" name="db_type" value=1 />';//1- авто від користувачів
        echo '</form>';
        echo '</td>';
       
        
       echo '</tr></table>';
    // previewAuctionCar(0);
     //previewAuctionCar(1   );
     echo '</div>';
    }
    
    
?>
<script type="text/javascript">
  function submitMy(formNumb)
  {
      document.forms["form"+formNumb].submit(); 
  }
  </script>



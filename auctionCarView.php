<?
session_start();
if( array_key_exists('id_car',$_POST)) 
{
    $_SESSION['id_car'] = $_POST['id_car'];
}


    
    echo '<body onload="time()">';
    function auctionCarView($id_car)
    {
        
include_once 'siteparts/siteHeader.php';
echo '<script src="script/script.js"></script>';
        echo '<div class="contentSearchPage " style=" height:120vh"> ';
        echo '<div class="mainPart">';
        
        include_once 'conect.php';
        $dbh = conectDb('car');
        $sql ="SELECT * FROM `auction_lot` WHERE auction_lot.fid_car='$id_car'";
        foreach($dbh->query($sql) as $row)
        {$date = new DateTime();
            $date->setTimestamp($row['time_end']); //D M j G:i:s T Y
        echo '<script type="text/javascript">
        
        timeend=new Date("'.$date->format('F j, Y, H:i:s') .'");
        
        function time()
        {
            idCar = '.$id_car.'
            today = new Date();
            
            if (timeend-today > 0)
            {
                today = Math.floor((timeend-today)/1000);
                tsec=today%60; today=Math.floor(today/60); if(tsec<10)tsec="0"+tsec;
                tmin=today%60; today=Math.floor(today/60); if(tmin<10)tmin="0"+tmin;
                thour=today%24; today=Math.floor(today/24);
                
                timestr=today +" днів "+ thour+" годин "+tmin+" хвилин "+tsec+" секунд";
            }
            else
            { timestr="Аукціон закінчено";}
            document.getElementById("t").innerHTML=timestr;
            getCurrentPrice(idCar);
            window.setTimeout("time()",1000);
        }
        </script>';
        break;
          }


        $sql = "SELECT * FROM auction_car WHERE auction_car.id_car = '$id_car'";
        echo '<div class="baseInfo">';
        foreach($dbh->query($sql) as $row)
        {
            echo '<span class="carNameView">'.$row["brand"].' '.$row["model"].'</span> ';
            $sql =  "SELECT * FROM `auction_lot` WHERE auction_lot.fid_car='$id_car'";
            foreach($dbh->query($sql) as $row)
            {               
                echo '<span id="currentprice" name="currentprice" class="priceView">Поточна ціна: $'.$row["current_price"].'</span>';
                break;
            }
            break;
        } 
        echo '</div>';

        
        include_once 'auctionCarGalery.php'; 
        
            echo '<div style="float:left; margin-right: 10px;">';
            createGallery($id_car);
            echo '</div>';
            echo '<div class="search_result regandlog" style="display:inline-block;  ">';
            echo '<div style="float:left text-alight:center">';
            echo '<span style="font-size:16px">До кінця аукціону:</span><br>';// таймер
            echo '<span id="t" style="font-size:16px"></span>';// таймер

            include_once 'siteParts/usercheck.php';
            $user = checkUser();
            if ($user != false )
            {
                echo '<table border="0" align="center" >';
                echo '<form  method="get">';

                echo '<input id="id_car" name="id_car" type="hidden" value='.$id_car.'>
                <input id="user_id" type="hidden" value='.$user['user_id'].'>
                <input id="minimal_bet" type="hidden" value='.$row["minimal_bet"].'>';
                echo '<tr><td><input type="number" id="bet" value="'.$row["minimal_bet"].'" min="'.$row["minimal_bet"].'" placeholder="'.$row["minimal_bet"].'" step="'.$row["minimal_bet"].'" required></td>';
                
               

                echo '<td> <input class="button"  type="Submit"  onclick="getWinner()" value="Зробити ставку"></td></tr>'; 
                echo '</form>';
                echo '</table>';
            }
            echo '</div><br>';

           
            $sql="SELECT * FROM auction_winer WHERE auction_winer.fid_car='$id_car'"; 
            foreach($dbh->query($sql) as $row)
            {
                if ($row['fid_user'] == 0)
                {
                    echo "<span>Лідерів аукціону поки що немає</span>";
                }
                else
                {
                    echo '<span>Лідер аукціону </span> <br> <table class="regandlog"  border="0" >';
                    echo '<tr><td>Ставка лідера :</td><td>'.$row["bet"].'</td></tr>';
                    $dbh = conectDb('users');
                    $sql = "SELECT * FROM users WHERE users.user_id = ".$row['fid_user'].""; 
                    foreach($dbh->query($sql) as $row)
                     {
                        echo '<tr><td>Логін лідера аукціону:</td><td>'.$row["user_login"].'</td></tr>';
                        if($user['role'] != 'user')
                        {
                            echo '<tr><td>Пошта:</td><td>'.$row["user_mail"].'</td></tr>';
                            echo '<tr><td>Телефонний номер:</td><td>'.$row["user_number"].'</td></tr>';
                            echo '<tr><td>Id користувача:</td><td>'.$row["user_id"].'</td></tr>';
                            echo '<tr><td>Роль користувача:</td><td>'.$row["role"].'</td></tr>';
                        }
                        break;
                     }
                    
                    echo '</table>';

                }

                break;
            }
            echo '</div>';
            

            $sql = "SELECT * FROM auction_car WHERE auction_car.id_car = '$id_car'";
            $dbh = conectDb('car');
            foreach($dbh->query($sql) as $row)
            { 
                echo '<div class="Specs" style="display:block;position: relative;  ">';
                echo '<div  style=margin-left:20px>';
                echo '<span>Характеристики:</span>';
                echo '<table border="0" ><tr><td>Рік виготовлення:</td><td>'.$row["year"].'</td></tr>';
                echo '<tr><td>Двигун:</td><td>'.$row["volume"].' л</td></tr>';
                echo '<tr><td>Тип пального:</td><td>'.$row["fuel"].'</td></tr>';
                echo '<tr><td>Потужність:</td><td>'.$row["horse_power"].' кс</td></tr>';
                echo '<tr><td>Стан:</td><td>'.$row["car_condition"].'</td></tr>';
                echo '<tr><td>Пробіг:</td><td>'.$row["distance"].'км</td></tr>';
                echo '</table>';echo '</div>';
                
                echo ' <div class="descContainer" style="style="display:block;position: relative;float:left; width:100px "> <span class="descName">Опис:</span><br><span class = "description">'.$row['description'].'</span> </div>';
                echo '</div>';
            }

       
            echo '</div>';
        echo '</div>';
    }  


    if(array_key_exists('id_car',$_POST))
    {
        auctionCarView( $_POST['id_car']); 
    }
    else
    {auctionCarView($_SESSION['id_car']);}

    //auctionCarView(0);
    echo '</body >';
    
?>

<body>
<?

function viewCar($id_car)
    {
  

    include 'galery.php';
    include 'conect.php';

    echo '<form name="form'.$id_car.'" action="byCar.php" method="post">';
            echo '<input type="hidden" name="id_car" value='.$id_car.' />';    
        echo '</form>';

        echo '<form name="form0" action="changeCarInfo.php" method="post">';
        echo '<input type="hidden" name="id_car" value='.$id_car.' />';
        echo '<input type="hidden" name="db_type" value=0 />';//1- авто від користувачів
        echo '</form>';
    $dbh = conectDb('car');

        $sql = "SELECT * FROM car WHERE car.id_car = '$id_car'"; //$id_car



    echo '<body><div class="mainPart" >';

    echo '<div class="baseInfo">';
        foreach($dbh->query($sql) as $row)
        {
            echo '<span class="carNameView">'.$row["brand"].' '.$row["model"].'</span> ';
            echo '<span class="priceView">$'.$row["price"].'</span>';
        } 
    echo '</div>';

        echo '<div class="imagesSpecs">';

    createGallery($id_car);//$id_car


    foreach($dbh->query($sql) as $row)
        { 
            echo '<div class="Specs">';
            echo '<span>Характеристики:</span>';
            echo '<table border="0" ><tr><td>Рік виготовлення:</td><td>'.$row["year"].'</td></tr>';
            echo '<tr><td>Двигун:</td><td>'.$row["volume"].' л</td></tr>';
            echo '<tr><td>Тип пального:</td><td>'.$row["fuel"].'</td></tr>';
            echo '<tr><td>Потужність:</td><td>'.$row["horse_power"].' кс</td></tr>';
            echo '<tr><td>Стан:</td><td>'.$row["car_condition"].'</td></tr>';
            echo '<tr><td>Пробіг:</td><td>'.$row["distance"].'км</td></tr>';
            echo '</table>';

            include_once 'siteParts/usercheck.php';
            $user = checkUser();
            if ($user != false && $user['role'] != 'user')
            {
                echo '<br> <a class="button" style=" font-size:18px " href="javascript: submitMy(0)">Керування сторінкою</a>';            
            }
            echo '</div>';
            
           
            echo ' <span class="buyButton"><a href="javascript: submitMy('.$id_car.')"><span>Придбати авто</span></a></div></div>';

            
            echo '<span class="descName">Опис:</span>';
            echo ' <div class="descContainer"><span class = "description">'.$row['description'].'</span> </div>';
        }

    echo '</div></body>';
}

?>



<?

include 'siteParts/siteHeader.php';

echo '<div class="contentViewPage">';

if(array_key_exists('test',$_POST))
{
    viewCar($_POST['test']);
 }

 echo '</div>';
?>
<script type="text/javascript">
  function submitMy(formNumb)
  {
      document.forms["form"+formNumb].submit(); 
  }</script>
</body>
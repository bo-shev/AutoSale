<link rel="stylesheet" href="siteParts/style.css">
<?

function viewCar($id_car)
    {
    include 'siteParts/siteHeader.php';

    include 'galery.php';
    include 'conect.php';

    $dbh = conectDb('car');

        $sql = "SELECT * FROM car WHERE car.id_car = '$id_car'"; //$id_car



    echo '<body><div class="mainPart" style="width:50vw;">';

        foreach($dbh->query($sql) as $row)
        {
            echo '<span>'.$row["brand"].' '.$row["model"].'</span> ';
            echo '<span class="price">$'.$row["price"].'</span>';
        } 
    createGallery($id_car);//$id_car


    foreach($dbh->query($sql) as $row)
        {
            echo '<p><b>Характеристики:</b></p>';
            echo '<table border="0" ><tr><td>Рік виготовлення:</td><td>'.$row["year"].'</td></tr>';
            echo '<tr><td>Двигун:</td><td>'.$row["volume"].' л</td></tr>';
            echo '<tr><td>Тип пального:</td><td>'.$row["fuel"].'</td></tr>';
            echo '<tr><td>Потужність:</td><td>'.$row["horse_power"].' кс</td></tr>';
            echo '<tr><td>Стан:</td><td>'.$row["car_condition"].'</td></tr>';
            echo '<tr><td>Пробіг:</td><td>'.$row["distance"].'км</td></tr>';

            echo '</table>';
            echo '<p><b>Опис:</b></p>';
            echo '<span class = "description">'.$row['description'].'</span>';
        }
    echo '</div></body>';
}



if(array_key_exists('test',$_POST))
{
    viewCar($_POST['test']);
 }
?>
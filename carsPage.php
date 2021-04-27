<?
include_once 'siteParts/siteHeader.php';
?>

<body>
    
<div class="contentSearchPage">
    <div style="display: block;
    text-align: center;">
        <?
            include_once 'searchform.php';
        ?>
    </div>



<?

function createQuery($brand, $fuel, $mindistance,$maxdistance, $model, $minpower, $maxpower,
$car_condition, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear)
{
   
    $sql = "SELECT id_car FROM car WHERE true";

    if ($car_condition != "0")   
    {
        $sql= $sql.' and car_condition = "'.$car_condition.'"';
    }
    if ($brand != "0")
    {
        $sql= $sql.' and brand = "'.$brand.'"';
    }
    if ($fuel != "0")
    {
        $sql= $sql.' and fuel = "'.$fuel.'"';
    }

    if ($mindistance != "")
    {
        $sql= $sql.' and distance >= '.$mindistance;
    }
    if ($maxdistance != "")
    {
        $sql= $sql.' and distance <= '.$maxdistance;
    }
    if ($model != "0")
    {
        $sql= $sql.' and model = "'.$model.'"';
    }

    if ($minpower != "")
    {
        $sql= $sql.' and horse_power >= '.$minpower;
    }
    if ($maxpower != "")
    {
        $sql= $sql.' and horse_power <= '.$maxpower;
    }

    if ($minvalue != "")
    {
        $sql= $sql.' and volume >= '.$minvalue;
    }
    if ($maxvalue != "")
    {
        $sql= $sql.' and volume <= '.$maxvalue;
    }
    if ($minprice != "")
    {
        $sql= $sql.' and price >= '.$minprice;
    }
    if ($maxprice != "")
    {
        $sql= $sql.' and price <= '.$maxprice;
    }
    if ($minyear != "")
    {
        $sql= $sql.' and year >= '.$minyear;
    }
    if ($maxyear != "")
    {
        $sql= $sql.' and year <= '.$maxyear;
    }
 return $sql;
}



function printCars($sql)
{
    echo $sql;
    include_once 'carPreview.php';
    include_once 'conect.php';

    $dbh = conectDb('car');

    $iterator =0;
    echo '<table class="searchResTable">';
    foreach($dbh->query($sql) as $row)
         {  
             if ($iterator %2 == 0)
             {
                echo '<tr>';
             }
             echo '<td class="carRes">';         
            previewCar($row["id_car"]);
            echo '</td>';  
            if ($iterator %2 !=0)
            {
               echo '</tr>';
            }
            $iterator++;
         }
         $dbh = null;
    echo '</table>';
}



if(array_key_exists('brand',$_POST))
{
  printCars( createQuery($_POST['brand'], $_POST['fuel'],$_POST['mindistance'],
     $_POST['maxdistance'], $_POST['model'] ,$_POST['minpower'],
     $_POST['maxpower'], $_POST['car_condition'],$_POST['minvalue'],$_POST['maxvalue'],$_POST['minprice'],$_POST['maxprice']
     ,$_POST['minyear'],$_POST['maxyear']));
}//,$_POST['maxyear']

?>




</div>
</body>

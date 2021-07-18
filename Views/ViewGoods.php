<?php
include_once "../HtmlParts/siteHeader.php";
?>

<div class="contentSearchPage" style = "min-height: 100%;">
    <br><br><br><br>
    <div style="display: block;    text-align: center;">
        <?
        include_once 'searchform.php';
        ?>
    </div>
    <table class="searchResTable">
        <?php
            function previewCars($carsArr)
            {
                $iterator =0;
                foreach($carsArr as $row)
                {
                    if ($iterator %2 == 0)
                    {
                        echo '<tr>';
                    }
                    echo '<td class="carRes">';
                    $arrWithCharacteristics = $row->getArrayCarInfo();
                    echo '<a href="../Controllers/ItemPageController.php?item_id='.$row->getId().'">';
                    echo '<div class="column">';
                    echo '<div class="card">';
                    echo '<img src="../upload/'.$row->getPhoto().'" alt="Car" style="width:98%; height: 350px;margin-top:6px">';
                    echo '<div class="container">';

                    echo '<span class="carName">'.$arrWithCharacteristics["brand"].' '.$arrWithCharacteristics["model"].' </span>';
                    echo '<span class="price">$'.$arrWithCharacteristics["price"].'</span>';

                    echo '</div></div></a>';
                    echo  '</div>';
                    echo '<div class="carInfo">
                              
                             <table>
                                
                                 <tr>
                                     <td>Рік:</td>
                                     <td>'.$arrWithCharacteristics["year"].'</td>
                                     <td>Тип палива:</td>
                                     <td>'.$arrWithCharacteristics["fuelType"].'</td>
                                 </tr>
                                 <tr>
                                     <td>Об*єм двигуна:</td>
                                     <td>'.$arrWithCharacteristics["volume"].' л</td>
                                     <td>Потужність:</td>
                                     <td>'.$arrWithCharacteristics["horsePower"].' кс</td>
                                 </tr>
                             </table>
                         </div>';

                    echo '</td>';

                    if ($iterator %2 !=0)
                    {
                        echo '</tr>';
                    }
                    $iterator++;
                }
            }
        if(array_key_exists('brand',$_GET))
        {
            previewCars($carFromDb->getCarsFromDb($_GET['brand'], $_GET['fuel'],$_GET['mindistance'], $_GET['maxdistance'], $_GET['model'] ,$_GET['minpower'],
                $_GET['maxpower'],$_GET['minvalue'],$_GET['maxvalue'],$_GET['minprice'],$_GET['maxprice'],$_GET['minyear'],$_GET['maxyear']));

        }

        ?>
    </table>
</div>
<?php
include_once "../HtmlParts/footer.php";
?>

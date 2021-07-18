<?php

include_once "../HtmlParts/siteHeader.php";


echo '<div class="contentViewPage" style = "min-height: 90%;">';
echo '<body><div class="mainPart" ><br><br>';

echo '<div class="baseInfo">';

echo '<span class="carNameView">'.$carInfo["brand"].' '.$carInfo["model"].'</span> ';
echo '<span class="priceView">$'.$carInfo["price"].'</span>';

echo '</div>';

echo '<div class="imagesSpecs">';

include '../Views/galery.php';


echo '<div class="Specs">';
echo '<span>Характеристики:</span>';
echo '<table border="0" ><tr><td>Рік виготовлення:</td><td>'.$carInfo["year"].'</td></tr>';
echo '<tr><td>Двигун:</td><td>'.$carInfo["volume"].' л</td></tr>';
echo '<tr><td>Тип пального:</td><td>'.$carInfo["fuelType"].'</td></tr>';
echo '<tr><td>Потужність:</td><td>'.$carInfo["horsePower"].' кс</td></tr>';
echo '<tr><td>Пробіг:</td><td>'.$carInfo["distance"].'км</td></tr>';
echo '</table>';


echo '<br>';
echo ' <span class="buyButton"><a href="../Controllers/buyingController.php?'.$_GET["item_id"].'"><span  >Придбати авто</span></a>';
echo '</div>';


// echo ' <span class="buyButton"><a href="javascript: submitMy('.$id_car.')"><span  >Придбати авто</span></a>';
echo '</div></div>';

echo '<span class="descName">Опис:</span>';
echo ' <div class="descContainer"><span class = "description">'.$carInfo['description'].'</span> </div>';


echo '</div></body>';

echo '</div>';
include_once "../HtmlParts/footer.php";
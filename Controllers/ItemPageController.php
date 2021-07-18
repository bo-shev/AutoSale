<?php

include_once "../models/Goods.php";

$item = new SearchItemById;
$car = $item->getItemCarById($_GET["item_id"]);

$carPhotos = $car->getPhotos();
$carInfo = $car->getArrayCarInfo();

include_once "../Views/carPageView.php";
<?php

if (isset($_GET["item_id"])){

    include_once "../Models/SearchItemById.php";

    $item = new SearchItemById;
    $car = $item->getItemCarById($_GET["item_id"]);

    $carPhotos = $car->getPhotos();
    $carInfo = $car->getArrayCarInfo();

    include_once "../Views/CarPageView.php";
}
else
{
    $textForUser = "Шуканий вами товар відсутній";
    include_once '../Views/InfoForUserView.php';
}
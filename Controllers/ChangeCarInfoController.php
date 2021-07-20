<?php

include_once '../Models/Goods.php';

$searchCar = new SearchItemById;

$car = $searchCar->getItemCarById($_GET['car_id']);
$carInfo = $car->getArrayCarInfo();

if (isset($_POST['change']))
{
    $changeInfo = new ChangeCarInfo();
    $changeInfo->changeCarInfo($_POST['idcar'], $_POST['brand'], $_POST['model'], $_POST['price'], $_POST['hp'], $_POST['volume'],$_POST['fuel'], $_POST['distance'],$_POST['year'], $_POST['description']);
    header("Refresh:0");
}
if (isset($_POST['delete']))
{
    $changeInfo = new ChangeCarInfo();
    $changeInfo->deleteCar($_POST['idcar']);
}

include_once '../Views/ChangeInfoView.php';

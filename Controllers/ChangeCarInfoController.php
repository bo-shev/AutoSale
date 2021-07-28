<?php

if (isset($_GET['car_id']))
{
    include_once '../Models/SearchItemById.php';

    $searchCar = new SearchItemById;

    $car = $searchCar->getItemCarById($_GET['car_id']);
    $carInfo = $car->getArrayCarInfo();

    if (isset($_POST['change']))
    {
        include_once '../Models/ChangeCarInfo.php';
        $changeInfo = new ChangeCarInfo();
        $changeInfo->changeCarInfo($_POST['idcar'], $_POST['brand'], $_POST['model'], $_POST['price'], $_POST['hp'], $_POST['volume'], $_POST['fuel'], $_POST['distance'], $_POST['year'], $_POST['description']);
        header("Refresh:0");
    }
    if (isset($_POST['delete']))
    {
        include_once '../Models/DeleteCar.php';
        $changeInfo = new DeleteCar();
        $changeInfo->deleteCar($_POST['idcar']);
    }

    include_once '../Views/ChangeInfoView.php';
}
else
{
    $textForUser = "Відсутні права доступу до цієї сторінки";
    include_once '../Views/InfoForUserView.php';
}
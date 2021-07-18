<?php

include_once "../models/Goods.php";
include_once "../models/Photos.php";

class InsertCarController //implements Iinsert
{
    private $car;
    private $photos;

    public function __construct()
    {
        $this->car = new Car($_POST['brand'], $_POST['model'], $_POST['price'], $_POST['horsePower'], $_POST['volume'], $_POST['fuelType'], $_POST['carMileage'], $_POST['year'], $_POST['description']);
        $this->photos = new Photo("car");
    }

    public function insertFiles()
    {
        $this->photos->uploadImage($_FILES);
    }

    public function insertCar()
    {
        $addCar = new AddCar($this->car);
        $addCar->addGoods();
    }
}

$controller = new InsertCarController();
$controller->insertFiles();
$controller->insertCar();

header("Location: ../Views/ViewAfterUpload.php");
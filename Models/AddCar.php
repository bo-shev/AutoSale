<?php

require_once "../Models/WorkWithDb.php";

class AddCar
{
    use WorkWithDb;

    private $car;
    public function __construct($newCar)
    {
        $this->car = $newCar;
    }

    public function addGoods()
    {
        $dataBase = $this->prepareConnectionDb();

        $carInfo = $this->car->getArrayCarInfo();

        $this->insertGoods($dataBase, $carInfo);
    }

    private function insertGoods($dataBase, $carInfo)
    {
        $newCarId = $this->getGoodsMaxId($dataBase);

        $smth=$dataBase->dbh->prepare("INSERT INTO `cars` (`id`, `brand`, `model`, `price`) VALUES ('".$newCarId[0]."', '".$carInfo['brand']."', '".$carInfo['model']."', '".$carInfo['price']."')");
        $smth->execute();

        $smth=$dataBase->dbh->prepare("INSERT INTO `car_info` (`id`, `fk_car_id`, `horse_power`, `volume`, `fuel_type`, `car_mileage`, `year`, `description`) VALUES (NULL, '".$newCarId[0]."', '".$carInfo['horsePower']."', '".$carInfo['volume']."', '".$carInfo['fuelType']."', '".$carInfo['carMileage']."', '".$carInfo['year']."', '".$carInfo['description']."')");
        $smth->execute();
    }
}
<?php

require_once "../Models/WorkWithDb.php";

class ChangeCarInfo
{
    use WorkWithDb;

    private $dataBase;

    public function __construct()
    {
        $this->dataBase = $this->prepareConnectionDb();
    }

    public function changeCarInfo($id, $brand, $model,$price, $horsePower, $volume, $fuelType, $carMileage, $year, $description)
    {
        $smth= $this->dataBase->dbh->prepare("UPDATE cars SET brand = :brand , model = :model, price = :price WHERE id=:id;");

        $smth->bindParam(':id', $id);
        $smth->bindParam(':brand', $brand);
        $smth->bindParam(':model', $model);
        $smth->bindParam(':price', $price);
        $smth->execute();

        $smth= $this->dataBase->dbh->prepare("UPDATE car_info SET horse_power = :horsePower , volume = :volume, fuel_type = :fuelType, car_mileage = :carMileage, year = :year, description = :description WHERE fk_car_id=:id;");

        $smth->bindParam(':id', $id);
        $smth->bindParam(':horsePower', $horsePower);
        $smth->bindParam(':volume', $volume);
        $smth->bindParam(':fuelType', $fuelType);
        $smth->bindParam(':carMileage', $carMileage);
        $smth->bindParam(':year', $year);
        $smth->bindParam(':description', $description);
        $smth->execute();
    }

}
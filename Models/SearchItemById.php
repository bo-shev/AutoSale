<?php

require_once "../Models/WorkWithDb.php";
require_once "../Models/CarItem.php";

class SearchItemById
{
    use WorkWithDb;

    public function getItemCarById($id)
    {
        $dataBase = $this->prepareConnectionDb();
        $smth=$dataBase->dbh->prepare('SELECT * FROM cars JOIN car_info ON cars.id = car_info.fk_car_id WHERE car_info.fk_car_id = :id');
        $smth->bindParam(':id', $id);
        $smth->execute();

        $row = $smth->fetch();
        $carFormDb = new CarItem($row['brand'], $row['model'], $row['price'], $row['horse_power'], $row['volume'], $row['fuel_type'], $row['car_mileage'], $row['year'], $row['description']);
        $carFormDb->setId($id);
        $carFormDb->setPhotos($id);

        return $carFormDb;
    }
}


<?php

require_once "../Models/WorkWithDb.php";
require_once "../Models/CarItem.php";

class SearchCars
{
    use WorkWithDb;

    private  $sqlPartsForRequest = array(' and brand like ', ' and fuel_type = ', ' and model = ', ' and car_mileage >= ', ' and car_mileage <= ', ' and horse_power >= ', ' and horse_power <= ', ' and volume >= ', ' and volume <= ', ' and price >= ', ' and price <= ', ' and year >= ', ' and year <= ');

    private function prepareRequest($searchedInfoCar)
    {
        $sql = "SELECT * FROM cars JOIN car_info ON cars.id = car_info.fk_car_id JOIN goods ON goods.id = car_info.fk_car_id WHERE true and goods.category='car'";

        for ($i = 0; $i < count($searchedInfoCar); $i++)
        {
            if($searchedInfoCar[$i] != "0" && $searchedInfoCar[$i] != "")
            {
                $sql = $sql .$this->sqlPartsForRequest[$i]."'$searchedInfoCar[$i]'";
            }
        }
        return $sql;
    }

    private function findCars($searchedInfoCar)
    {
        $sql = $this->prepareRequest($searchedInfoCar);

        $dataBase = $this->prepareConnectionDb();
        $smth=$dataBase->dbh->prepare($sql);
        $smth->execute();
        return $smth->fetchAll();
    }

    public function getCarsFromDb($brand, $fuel, $mindistance,$maxdistance, $model, $minpower, $maxpower, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear)
    {

        $searchedInfoCar = array($brand, $fuel, $model, $mindistance,$maxdistance, $minpower, $maxpower, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear);
        $carsObjArray =array();

        foreach($this->findCars($searchedInfoCar) as $row)
        {
            $carFormDb = new CarItem($row['brand'], $row['model'], $row['price'], $row['horse_power'], $row['volume'], $row['fuel_type'], $row['car_mileage'], $row['year'], $row['description']);
            $carFormDb->setId($row['fk_car_id']);

            $carFormDb->setPhotos($row['fk_car_id']);

            array_push($carsObjArray, $carFormDb);
        }
        return $carsObjArray;
    }
}
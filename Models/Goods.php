<?php

require_once "../models/connectDb.php";
require_once "../models/TraitDb.php";
require_once "../models/Photos.php";

interface IAddGoods
{
    public function addGoods();
}

class AddCar implements IAddGoods
{
    use CarShop;

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

class Car
{
    protected  $brand;
    protected  $model;
    protected  $price;
    protected  $horsePower;
    protected  $volume;
    protected  $fuelType;
    protected  $carMileage;
    protected  $year;
    protected  $description;

    public function __construct($brand, $model, $price, $horsePower, $volume, $fuelType, $carMileage, $year, $description)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
        $this->horsePower = $horsePower;
        $this->volume = $volume;
        $this->fuelType = $fuelType;
        $this->carMileage = $carMileage;
        $this->year = $year;
        $this->description = $description;
    }
    public function getArrayCarInfo()
    {
        $carInfo = array(
            "brand" => $this->brand,
            "model" => $this->model,
            "price" => $this->price,
            "horsePower" => $this->horsePower,
            "volume" => $this->volume,
            "fuelType" => $this->fuelType,
            "carMileage" => $this->carMileage,
            "year" => $this->year,
            "description" => $this->description,
        );
        return $carInfo;
    }
}

class GoodsInfo
{
    use CarShop;

    private function getColumnFromCars($column)
    {
        $dataBase = $this->prepareConnectionDb();
        $smth=$dataBase->dbh->prepare("SELECT ".$column." FROM cars");
        $smth->execute();

        return $smth->fetchAll();
    }

    public function getCarBrands()
    {
        return $this->getColumnFromCars("brand");
    }

    public function getCarModels()
    {
        return $this->getColumnFromCars("model");
    }
}

class ItemCar extends Car
{
    private $id;
    private $photos;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setPhotos($itemId)
    {
        $photoNames = new Photos($itemId);
        $this->photos = $photoNames->getPhotoNames();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getPhotos()
    {
        return $this->photos;
    }
    public function getPhoto()
    {
        return $this->photos[0];
    }
}

class SearchItemById
{
    use CarShop;

    public function getItemCarById($id)
    {
        $dataBase = $this->prepareConnectionDb();
        $smth=$dataBase->dbh->prepare('SELECT * FROM cars JOIN car_info ON cars.id = car_info.fk_car_id WHERE car_info.fk_car_id = :id');
        $smth->bindParam(':id', $id);
        $smth->execute();

        $row = $smth->fetch();
        $carFormDb = new ItemCar($row['brand'], $row['model'], $row['price'], $row['horse_power'], $row['volume'], $row['fuel_type'], $row['car_mileage'], $row['year'], $row['description']);
        $carFormDb->setId($id);
        $carFormDb->setPhotos($id);

        return $carFormDb;
    }
}


class SearchCars
{
    use CarShop;

    private function prepareRequest($brand, $fuel, $mindistance,$maxdistance, $model, $minpower, $maxpower, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear)
    {
        $sql = "SELECT * FROM cars JOIN car_info ON cars.id = car_info.fk_car_id WHERE true";

        if ($brand != "0")
        {
            $sql = $sql .' and brand = "'.$brand.'"';
        }
        if ($fuel != "0")
        {
            $sql = $sql .' and fuel_type = "'.$fuel.'"';
        }

        if ($mindistance != "")
        {
            $sql = $sql .' and car_mileage >= '.$mindistance;
        }
        if ($maxdistance != "")
        {
            $sql = $sql .' and car_mileage <= '.$maxdistance;
        }
        if ($model != "0")
        {
            $sql = $sql .' and model = "'.$model.'"';
        }

        if ($minpower != "")
        {
            $sql = $sql .' and horse_power >= '.$minpower;
        }
        if ($maxpower != "")
        {
            $sql = $sql .' and horse_power <= '.$maxpower;
        }

        if ($minvalue != "")
        {
            $sql = $sql .' and volume >= '.$minvalue;
        }
        if ($maxvalue != "")
        {
            $sql = $sql .' and volume <= '.$maxvalue;
        }
        if ($minprice != "")
        {
            $sql = $sql .' and price >= '.$minprice;
        }
        if ($maxprice != "")
        {
            $sql = $sql .' and price <= '.$maxprice;
        }
        if ($minyear != "")
        {
            $sql = $sql .' and year >= '.$minyear;
        }
        if ($maxyear != "")
        {
            $sql = $sql .' and year <= '.$maxyear;
        }

        return $sql;
    }

    private function findCars($brand, $fuel, $mindistance,$maxdistance, $model, $minpower, $maxpower, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear)
    {
        $sql = $this->prepareRequest($brand, $fuel, $mindistance,$maxdistance, $model, $minpower, $maxpower, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear);

        $dataBase = $this->prepareConnectionDb();
        $smth=$dataBase->dbh->prepare($sql);
        $smth->execute();
        return $smth->fetchAll();
    }

    public function getCarsFromDb($brand, $fuel, $mindistance,$maxdistance, $model, $minpower, $maxpower, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear)
    {
        $carsId = $this->findCars($brand, $fuel, $mindistance,$maxdistance, $model, $minpower, $maxpower, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear);
        $carsObjArray =array();

        foreach($this->findCars($brand, $fuel, $mindistance,$maxdistance, $model, $minpower, $maxpower, $minvalue,$maxvalue,$minprice,$maxprice,$minyear,$maxyear) as $row)
        {
            $carFormDb = new ItemCar($row['brand'], $row['model'], $row['price'], $row['horse_power'], $row['volume'], $row['fuel_type'], $row['car_mileage'], $row['year'], $row['description']);
            $carFormDb->setId($row['fk_car_id']);

            $carFormDb->setPhotos($row['fk_car_id']);
           // $photoNames = new Photos($row['fk_car_id']);
           // $carFormDb->setPhotos($photoNames->getPhotoNames());

            array_push($carsObjArray, $carFormDb);
        }
        return $carsObjArray;
    }
}
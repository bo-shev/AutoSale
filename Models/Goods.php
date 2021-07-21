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
        $smth=$dataBase->dbh->prepare("SELECT DISTINCT ".$column." FROM cars");
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
        $sql = "SELECT * FROM cars JOIN car_info ON cars.id = car_info.fk_car_id JOIN goods ON goods.id = car_info.fk_car_id WHERE true and goods.category='car'";

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

            array_push($carsObjArray, $carFormDb);
        }
        return $carsObjArray;
    }
}

class ChangeCarInfo
{
    use CarShop;

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

    private  function deletePhotoFromFolder($photoName)
    {
        unlink('../upload/'.$photoName);
    }

    private function requestToDb($id, $sql)
    {
        $smth=$this->dataBase->dbh->prepare($sql);
        $smth->bindParam(':id', $id);
        $smth->execute();
        return $smth;
    }

    public function deleteCar($id)
    {
        $smth = $this->requestToDb($id, "SELECT name FROM photos WHERE fk_goods_id = :id");
        foreach ($smth->fetchAll() as $row)
        {
            $this->deletePhotoFromFolder($row['name']);
        }
        $this->requestToDb($id, "DELETE FROM `photos` WHERE fk_goods_id = :id");
        $this->requestToDb($id, "DELETE FROM `car_info` WHERE fk_car_id = :id");
        $this->requestToDb($id, "DELETE FROM `cars` WHERE `cars`.`id` = :id");
        $this->requestToDb($id, "DELETE FROM `goods` WHERE `goods`.`id` = :id");
    }
}

class Orders
{
    use CarShop;

    private $dataBase;

    public function __construct()
    {
        $this->dataBase = $this->prepareConnectionDb();
    }

    public function makeOrder($itemId, $userId)
    {
        $smth=$this->dataBase->dbh->prepare("INSERT INTO `orders` (`id`, `fk_user_id`, `fk_car_id`) VALUES (NULL, :userId, :itemId)");
        $smth->bindParam(':itemId', $itemId);
        $smth->bindParam(':userId', $userId);
        $smth->execute();
    }

    public function getOrdersInfo()
    {
        $smth=$this->dataBase->dbh->prepare("SELECT users.id AS user_id, users.user_login, users.user_mail, users.user_number, orders.id AS order_id, cars.brand, cars.model, cars.price FROM users JOIN orders ON users.id=orders.fk_user_id JOIN cars ON orders.fk_car_id=cars.id");
        $smth->execute();

        return $smth->fetchAll();
    }

    public function deleteOrderById($id)
    {
        $smth=$this->dataBase->dbh->prepare("DELETE FROM `orders` WHERE `orders`.`id` = :id");
        $smth->bindParam(':id', $id);
        $smth->execute();
    }
}



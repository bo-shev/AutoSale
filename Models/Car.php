<?php

require_once "../Models/WorkWithDb.php";

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
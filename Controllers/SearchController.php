<?php

include_once "../Models/GoodsInfo.php";
include_once "../Models/SearchCars.php";

class SearchCarController
{
    public function sendBrandToView()
    {
        $brands = new GoodsInfo();
        return $brands->getCarBrands();
    }
    public function sendModelsToView()
    {
        $models = new GoodsInfo();
        return $models->getCarModels();
    }
}

$carFromDb = new SearchCars();

include_once '../Views/ViewGoods.php';


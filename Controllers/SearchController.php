<?php

include_once "../models/Goods.php";

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


<?php

require_once "../Models/WorkWithDb.php";

class GoodsInfo
{
    use WorkWithDb;

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
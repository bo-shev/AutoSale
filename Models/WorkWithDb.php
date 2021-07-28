<?php

require_once "../models/DataBase.php";

trait WorkWithDb
{
    public function getGoodsMaxId($dataBase)
    {
        $smth=$dataBase->dbh->prepare("SELECT MAX(id) as id FROM goods");
        $smth->execute();

        $newCarId = $smth->fetch();
        return $newCarId;
    }

    public function prepareConnectionDb()
    {
        $dataBase = new DataBase("car-shop");
        $dataBase->connectDb();
        return $dataBase;
    }
}
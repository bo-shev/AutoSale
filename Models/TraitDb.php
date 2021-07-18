<?php

require_once "../models/connectDb.php";

trait CarShop
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
        $dataBase = new database("car-shop");
        $dataBase->connectDb();
        return $dataBase;
    }
}
<?php

require_once "../Models/WorkWithDb.php";

class DeleteCar
{
    use WorkWithDb;

    private $dataBase;

    public function __construct()
    {
        $this->dataBase = $this->prepareConnectionDb();
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

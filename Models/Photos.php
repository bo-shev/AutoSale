<?php

require_once "../Models/WorkWithDb.php";

class Photos
{
    use WorkWithDb;

    private $photoNames = array();

    public function __construct($itemId)
    {
        $dataBase = $this->prepareConnectionDb();
        $smth = $dataBase->dbh->prepare("SELECT name FROM photos WHERE photos.fk_goods_id = :itemId");
        $smth->bindParam(':itemId', $itemId);
        if ($smth->execute())
        {
            while ($row = $smth->fetch())
            {
                array_push($this->photoNames, $row['name']);
            }
        }
    }

    public function getPhotoNames()
    {
        return $this->photoNames;
    }
}

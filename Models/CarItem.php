<?php

require_once "../Models/WorkWithDb.php";
require_once "../Models/Photos.php";
require_once "../Models/Car.php";

class CarItem extends Car
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
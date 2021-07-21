<?php

include_once 'Goods.php';

class AuctionItem
{
    use CarShop;

    private $dataBase;

    public function __construct()
    {
        $this->dataBase = $this->prepareConnectionDb();
    }

    public function moveCarToAuction($idCar, $timeEnd, $startPrice, $minimalBet)
    {
        $smth=$this->dataBase->dbh->prepare("UPDATE goods SET category = 'auctionCar' WHERE id=:id");
        $smth->bindParam(':id', $idCar);
        $smth->execute();

        $smth=$this->dataBase->dbh->prepare("INSERT INTO `auction_lot` (`id_item`, `winner_id`, `time_end`, `current_price`, `minimal_bet`, `start_price`) VALUES (:id, NULL, :time_end, :start_price, :minimal_bet, :start_price)");
        $smth->bindParam(':id', $idCar);
        $smth->bindParam(':time_end', $timeEnd);
        $smth->bindParam(':start_price', $startPrice);
        $smth->bindParam(':minimal_bet', $minimalBet);
        $smth->execute();
    }

    public function getItemInfo($id)
    {
        $smth=$this->dataBase->dbh->prepare("SELECT auction_lot.current_price, auction_lot.time_end, auction_lot.minimal_bet, auction_lot.start_price, auction_lot.winner_id, cars.brand, cars.model, car_info.horse_power, car_info.volume, car_info.fuel_type, car_info.car_mileage, car_info.year, car_info.description FROM cars JOIN auction_lot ON auction_lot.id_item =cars.id JOIN car_info ON car_info.fk_car_id=cars.id WHERE auction_lot.id_item = :id");
        $smth->bindParam(':id', $id);
        $smth->execute();
        return $smth->fetch();
    }

    public function getCurrentWinner($id_lot)
    {
        $smth=$this->dataBase->dbh->prepare("SELECT users.user_login, users.user_mail, users.user_password, users.user_number FROM users JOIN auction_lot ON auction_lot.winner_id=users.id WHERE auction_lot.id_item = :id");
        $smth->bindParam(':id', $id_lot);
        $smth->execute();
        return $smth->fetch();
    }

    public function makeBet($idItem, $user, $bet)
    {
        $smth=$this->dataBase->dbh->prepare("UPDATE auction_lot SET winner_id = :user , current_price = (:bet+auction_lot.current_price) WHERE auction_lot.id_item=:id");
        $smth->bindParam(':id', $idItem);
        $smth->bindParam(':user', $user);
        $smth->bindParam(':bet', $bet);
        $smth->execute();
    }

    public function getAllAuctionCar()
    {
        $smth=$this->dataBase->dbh->prepare("SELECT id_item FROM `auction_lot`");
        $smth->execute();
        return $smth->fetchAll();
    }
}


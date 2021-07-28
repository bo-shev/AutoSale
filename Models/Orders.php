<?php

class Orders
{
    use CarShop;

    private $dataBase;

    public function __construct()
    {
        $this->dataBase = $this->prepareConnectionDb();
    }

    public function makeOrder($itemId, $userId)
    {
        $smth=$this->dataBase->dbh->prepare("INSERT INTO `orders` (`id`, `fk_user_id`, `fk_car_id`) VALUES (NULL, :userId, :itemId)");
        $smth->bindParam(':itemId', $itemId);
        $smth->bindParam(':userId', $userId);
        $smth->execute();
    }

    public function getOrdersInfo()
    {
        $smth=$this->dataBase->dbh->prepare("SELECT users.id AS user_id, users.user_login, users.user_mail, users.user_number, orders.id AS order_id, cars.brand, cars.model, cars.price FROM users JOIN orders ON users.id=orders.fk_user_id JOIN cars ON orders.fk_car_id=cars.id");
        $smth->execute();

        return $smth->fetchAll();
    }

    public function deleteOrderById($id)
    {
        $smth=$this->dataBase->dbh->prepare("DELETE FROM `orders` WHERE `orders`.`id` = :id");
        $smth->bindParam(':id', $id);
        $smth->execute();
    }
}


<?
    class order 
    {
        private $customer; // об'єкт класу користувача
        private $orderId;
        private $carId;

        function __construct($customer, $orderId, $carId)
        {
            $this->customer = $customer;
            $this->orderId = $orderId;
            $this->carId = $carId;
        }

        function deleteOrder()
        {
            include_once 'conect.php';

            $dbh = conectDb('users');

            //подготовленный запрос
            $smth=$dbh->prepare("DELETE FROM orders WHERE orders.order_id = '$this->orderId'");

            $smth->execute();
            $dbh = null;
        }
    }
?>
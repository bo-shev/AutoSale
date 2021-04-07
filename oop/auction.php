<?
    include_once 'car.php';
    include_once 'user.php';

    class auctionCar extends car
    {
        private $startPrice;
        private $maxPrice;

        function __construct($model, $mark, $status, $startPrice, $maxPrice)
        {
            $this->model = $model;
            $this->mark = $mark;          
            $this->status = $status;
            $this->startPrice = $startPrice;
            $this->maxPrice = $maxPrice;
        }

        function increasePrice($money)
        {
            $this->$startPrice += $money;
        }

        function showMinPrice()
        {
            return $this->$startPrice;
        }
        function showMaxPrice()
        {
            return $this->$maxPrice;
        }
    }


    class currentWinner
    {
        public $user; // об'єкт класу user

        function __construct($user = null)
        {
            $this->user = $user;            
        }

        function changeWinner($newWinner)
        {
            $this->user = $newWinner;
        }
    }


    class auctionLot
    {
        private $timeEnd;
        private $lot; // об'єкт класу auctionCar
        public $currWinner = new currentWinner(null);

        function __construct($timeEnd, $lot)
        {
            $this->timeEnd = $timeEnd;
            $this->lot = $lot;                      
        }

        function timeToEnd($now)
        {
            return  $timeEnd-$now;
        }

        function increaseLotPrice($money, $user)
        {
            $this->lot.increasePrice($money);
            $currWinner.changeWinner($user);
        }
    }

?>
<?
    class car 
    {
        private $model;
        private $mark;
        private $price;
        private $status; // Нова чи б/у
        
        function __construct($model, $mark, $price, $status)
        {
            $this->model = $model;
            $this->mark = $mark;
            $this->price = $price;
            $this->status = $status;
        }

        function getInfo()
        {
            return array(
                "model" => $this->model ,
                "mark" => $this->mark ,
                "price" => $this->price ,
                "status" => $this->status ,
            )
        }
     
    }



    class userCar extends car  //Клас машини користувача наслідує методи і змінні класу звичайного авто  
    {
        private $carOwner; // Це буде об'єктом класу carOwner

        function __construct($model, $mark, $price, $status, $carOwner)
        {
            $this->model = $model;
            $this->mark = $mark;
            $this->price = $price;
            $this->status = $status;
            $this->carOwner = $carOwner;
        }

        function getOwner()
        {
            return  $this->carOwner;
        }
    }

    include_once 'user.php';

    class carOwner
    {
        private $user;

        function __construct($user)
        {
            $this->user = $user;            
        }

        function getOwnerInfo()
        {
            return $user.getInfo();
        }

    }


?>
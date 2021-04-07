<?
    class user extends іsUserEntered
    {
        private $login;
        private $id;
        private $number;
        private $mail;
        public $role; // Роль користувача: admin, moder, user...

        function __construct($login, $id, $number, $mail, $role)
        {
            $this->login = $login;
            $this->id = $id;
            $this->number = $number;
            $this->mail = $mail;
            $this->role = $role;
        }

        function changeRole($newRole)
        {
            $this->role = $newRole;
        }

        function getInfo()
        {
            return array(
                "login" => $this->login ,
                "number" => $this->number ,
                "number" => $this->number ,
                "mail" => $this->mail ,
            )
        }

        function getSpecialInfo()
        {
            return array(
                "id" => $this->id ,
                "role" => $this->role ,               
            )
        }
    }


    class іsUserEntered
    {
        function checkUser()
        {
            $link=mysqli_connect("localhost", "root", "root", "users");

            if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
            {
                $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                $userdata = mysqli_fetch_assoc($query);

                if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']) )// Звіряємо інформацію в кеші
                {            
                    return  false;
                }
                else
                {   
                    return  $userdata; // Надсилаємо об'єкт з інформацією про користувача
                }
            }
            else
            {
                return  false;
            }  
        }
    }


    class roleCheaker
    {
        function cheack($user) // Надходить об'єкт користувача 
        {
            if ($user != null)
            {
                return $user.role;
            }
            else
            {
                return false;
            }
        }
    }

?>
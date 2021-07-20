<?php

require_once "../models/TraitDb.php";

interface IUser
{
    public function getUserInfoArr();
}

class User implements IUser
{
    use CarShop;

    private $dataBase;

    private $id;
    private $login;
    private $mail;
    private $number;
    private $role;

    public function __construct()
    {
        $this->dataBase = $this->prepareConnectionDb();
    }

    public function setUserById($id)
    {
        $smth=$this->dataBase->dbh->prepare("SELECT * FROM users WHERE id = :id ");
        $smth->bindParam(':id', $id);
        $smth->execute();

        $this->setUserInfo($smth->fetch());
    }

    public function setUserInfo($userInfo)
    {
        $this->id = $userInfo['id'];
        $this->login = $userInfo['user_login'];
        $this->mail = $userInfo['user_mail'];
        $this->number = $userInfo['user_number'];
        $this->role = $userInfo['role'];
    }

    public function getUserInfoArr()
    {
        $userInfo = array(
            'id' => $this->id,
            'userLogin' => $this->login,
            'userMail' => $this->mail,
            'userNumber' => $this->number,
            'role' => $this->role
        );
        return $userInfo;
    }

    public function isAuthorized()
    {
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
        {
            $id = $_COOKIE['id'];
            $hash = $_COOKIE['hash'];

            $smth=$this->dataBase->dbh->prepare("SELECT * FROM users WHERE id = :id and user_hash = :hash ");
            $smth->bindParam(':hash', $hash);
            $smth->bindParam(':id', $id);
            $smth->execute();


            $userInfo = $smth->fetch();

            if ($userInfo['id'] == $id && $userInfo['user_hash'] == $hash)
            {
                $this->setUserInfo($userInfo);
                return 'true';
            }
            else {return 'false';}
        }
    }

    public function changeRole($new_role, $id)
    {
        $smth=$this->dataBase->dbh->prepare("UPDATE users SET ROLE = :new_role WHERE id = :id");
        $smth->bindParam(':new_role', $new_role);
        $smth->bindParam(':id', $id);
        $smth->execute();
    }

    public function logOut()
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true);
    }
}

class AllUsers
{
    use CarShop;

    private $dataBase;
    private $users = array();

    public function __construct()
    {
        $this->dataBase = $this->prepareConnectionDb();

        $smth=$this->dataBase ->dbh->prepare("SELECT * FROM `users`");
        $smth->execute();

        foreach($smth->fetchAll() as $row)
        {
            $user = new User();
            $user->setUserInfo($row);
            array_push($this->users, $user);
        }
    }

    public function getUsers()
    {
        return $this->users;
    }
}

class Authorization
{
    use CarShop;

    private $dataBase;
    private $login;
    private $password;

    public function __construct($login, $password)
    {
        $this->dataBase = $this->prepareConnectionDb();

        $this->login = $login;
        $this->password = md5(md5($password));
    }

    private function setHash($userId, $hash)
    {
        $smth=$this->dataBase->dbh->prepare("UPDATE users SET user_hash= :hash  WHERE id= :user_id");
        $smth->bindParam(':hash', $hash);
        $smth->bindParam(':user_id', $userId);
        $smth->execute();
    }

    private function setCookie($userId, $hash)
    {
        setcookie("id", $userId, time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);
    }

    private function authorization($userId)
    {
        $hash = md5($this->generateCode(10));

        $this->setHash($userId, $hash);
        $this->setCookie($userId, $hash);
    }

    public function isUserInfoCorrect()
    {
        $smth=$this->dataBase->dbh->prepare("SELECT id, user_password, user_login FROM users WHERE user_login = :login");
        $smth->bindParam(':login', $this->login);
        $smth->execute();

        $userInfo = $smth->fetch();
        if ($userInfo['user_login'] == $this->login && $userInfo['user_password'] == $this->password)
        {
            $this->authorization($userInfo['id']);
            return true;
        }
        else { return  false;}
    }

    private function generateCode($length=6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length)
        {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
}

class Registration
{
    use CarShop;

    private $dataBase;
    private $newUserInfo;
    private $err = [];

    public function __construct($login, $mail, $password,  $number)
    {
        $this->dataBase = $this->prepareConnectionDb();

        $this->newUserInfo = array(
            "login" => $login,
            "mail" => $mail,
            "password" => $password,
            "number" => $number
        );
    }

    public function getErrors()
    {
        return $this->err;
    }

    private function isUserInfoCorrect()
    {
        //Перевірка номеру

        $pattern = "/^\+380\d{3}\d{2}\d{2}\d{2}$/";
        if(preg_match($pattern, $this->newUserInfo['number']))
        {
            $this->err[] =  "Номер не валідний";
        }
        //перевірка пошти
        if (!filter_var($this->newUserInfo['mail'], FILTER_VALIDATE_EMAIL))
        {
            $this->err[] = "E-mail адрес ".$this->newUserInfo['mail']."  вказано не вірно";
        }
        // проверям логин
        if(!preg_match("/^[a-zA-Z0-9]+$/",$this->newUserInfo['login']))
        {
            $this->err[] = "Логін може бути лиже латинецею і цифрами";
        }

        if(strlen($this->newUserInfo['login']) < 3 or strlen($this->newUserInfo['login']) > 30)
        {
            $this->err[] = "Зробіть логін довшим трьох символів і коротшим 30";
        }

        if($this->isUserLoginExist($this->newUserInfo['login']) == true)
        {
            $this->err[] = "Такий логін вже зайнятий";
        }

        if(count($this->err) == 0)
        {
            return true;
        }
        else { return  false;}
    }

    private function isUserLoginExist($login)
    {
        $smth=$this->dataBase->dbh->prepare("SELECT user_login FROM users WHERE user_login = :login");
        $smth->bindParam(':login', $login);
        $smth->execute();

        $userLogin = $smth->fetch();
        if ($userLogin['user_login'] == $login)
        {
            return true;
        }
        else { return  false;}
    }

    private function insertNewUser()
    {
        $password = md5(md5(trim($this->newUserInfo['password'])));

        $smth=$this->dataBase->dbh->prepare("INSERT INTO users SET user_login=:login, user_mail=:mail,  user_password=:password, user_number=:number, role='user'");
        $smth->bindParam(':login', $this->newUserInfo['login']);
        $smth->bindParam(':mail', $this->newUserInfo['mail']);
        $smth->bindParam(':password', $password);
        $smth->bindParam(':number', $this->newUserInfo['number']);
        $smth->execute();
    }

    public function createNewUser()
    {
        if($this->isUserInfoCorrect())
        {
            $this->insertNewUser();
            return true;
        }
        else {return false;}
    }
}


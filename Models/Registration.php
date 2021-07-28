<?php

require_once "../Models/WorkWithDb.php";

class Registration
{
    use WorkWithDb;

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


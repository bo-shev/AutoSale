<?php

require_once "../Models/WorkWithDb.php";

class Authorization
{
    use WorkWithDb;

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
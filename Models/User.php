<?php

require_once "../models/WorkWithDb.php";

class User
{
    use WorkWithDb;

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


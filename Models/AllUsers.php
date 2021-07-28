<?php

require_once "../Models/WorkWithDb.php";
require_once "../Models/User.php";

class AllUsers
{
    use WorkWithDb;

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

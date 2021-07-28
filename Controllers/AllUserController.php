<?php

include_once "../Models/AllUsers.php";

$users = new AllUsers();
$usersArr = $users->getUsers();

include_once "../Views/PageWithAllUsers.php";





<?php

include_once "../Models/Users.php";

$users = new AllUsers();
$usersArr = $users->getUsers();

include_once "../Views/PageWithAllUsers.php";





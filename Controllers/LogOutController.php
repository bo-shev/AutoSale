<?php
include_once "../Models/Users.php";

$user = new User();

if ($user->isAuthorized())
{
    $user->logOut();
}
header("Location: ../Controllers/SearchController.php");
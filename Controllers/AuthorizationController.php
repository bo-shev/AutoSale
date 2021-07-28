<?php

include_once "../Models/Authorization.php";

$errorText = '';

if(isset($_POST['submit']))
{
    $authorization = new Authorization($_POST['login'], $_POST['password']);

    if($authorization->isUserInfoCorrect())
    {
        header("Location: ../Controllers/SearchController.php");
    }
    else
    {
        $errorText = "Некоректні дані";
    }
}


include_once "../Views/LoginPage.php";
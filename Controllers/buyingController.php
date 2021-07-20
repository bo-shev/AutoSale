<?php

include_once "../Models/Users.php";
include_once '../Models/Goods.php';

$user = new User();
$user_info = 0;
$textForUser = "";

if ($user->isAuthorized())
{
    $user_info = $user->getUserInfoArr();

    $order = new Orders();
    $order->makeOrder($_GET["car_id"], $user_info["id"]);
    $textForUser = "Ваше замовдення прийнято, очікуйте дзвінок або лист на пошту!";
}
else { header("Location: ../Controllers/AuthorizationController.php");}

include '../Views/infoForUserView.php';


<?php

if(isset($_GET['id']))
{
    include_once "../Models/User.php";

    $user = new User();

    $user->setUserById($_GET['id']);
    $userPageInfo = $user->getUserInfoArr();

    include_once "../Views/UserPageView.php";

}
else
{
    $textForUser = "Не знайдено інформації про цього користувача";
    include_once '../Views/InfoForUserView.php';
}

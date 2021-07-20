<?php

include_once "../Models/Users.php";

$user = new User();

$user->setUserById($_GET['id']);
$userPageInfo = $user->getUserInfoArr();

include_once "../Views/UserPageView.php";



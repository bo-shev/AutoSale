<?php

include_once '../HtmlParts/SiteHeader.php';

echo '<div class="contentSearchPage regandlog pageheight"><br><br><br><br><br><br>';
switch ($user_info['role'])
{

    case 'user':
        echo '<a class = "button" href="../Controllers/SearchController.php">Придбати авто</a>';
        break;

    case 'admin':
        echo '<a class = "button" href="../Controllers/AllUserController.php">Список користувачів</a>';
        echo '<a class = "button" href="../Controllers/OrdersController.php">Переглянути замовлення</a>';
        echo '<a class = "button" href="../Views/AddCar.php">Додати авто</a>';
        break;

}
echo '</div>';
include_once '../HtmlParts/Footer.php';



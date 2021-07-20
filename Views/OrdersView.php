<?php
include_once "../HtmlParts/siteHeader.php";
echo '<div class="contentSearchPage " style = "min-height: 100%"><br><br><br><br><br><br> ';



foreach ($ordersInfo as $row)
{
    echo '<div class="search_result regandlog"  >';
    echo $row['brand'].' '.$row['model'].' '.$row['price'].'$ '.$row['year'].'p';
    echo '<br>Номер замовлення: '.$row["order_id"].'<br>';
    echo '<span>Інформація про користувача:</span>';
    echo '<table border="0" ><tr><td>Логін користувача:</td><td>'.$row["user_login"].'</td></tr>';
    echo '<tr><td>Пошта:</td><td>'.$row["user_mail"].'</td></tr>';
    echo '<tr><td>Телефонний номер:</td><td>'.$row["user_number"].'</td></tr>';
    echo '<tr><td>Індифікатор користувача:</td><td>'.$row["user_id"].'</td></tr>';
    echo '<tr><td>Роль користувача:</td><td>'.$row["role"].'</td></tr>';

    echo '</table>';

    echo '<a href="../Controllers/OrdersController.php?delete_order='.$row["order_id"].'" class="button right">Видалити замовлення</a>';
    echo ' </div><br>';

    echo '</form>';


}

echo "</div>";

include_once "../HtmlParts/footer.php";

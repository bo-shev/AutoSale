<?php


include_once "../HtmlParts/SiteHeader.php";

if ($user_info['role'] == "admin")
{
    include_once "../Models/Orders.php";
    $orders = new Orders();

    $ordersInfo = $orders->getOrdersInfo();

    if (isset($_GET['delete_order']))
    {
        $orders->deleteOrderById($_GET['delete_order']);
        header("Refresh:0");
    }

    include_once "../Views/OrdersView.php";


}
else
{
    $textForUser = "Відсутні права доступу до цієї сторінки";
    include_once '../Views/InfoForUserView.php';
}


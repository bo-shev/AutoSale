<?php

include_once '../Models/Auction.php';
include_once '../Models/SearchItemById.php';

$auction = new AuctionItem();

$item = new SearchItemById;

if (isset($_POST['moveToAuction']))
{
    include_once '../Views/MoveToAuctionView.php';
}

if (isset($_POST['confirm']))
{
    $auction->moveCarToAuction($_POST['id_car'], strtotime($_POST['auctionend']), $_POST['start_price'], $_POST['minimal_bet']);
    $textForUser = "Автомобіль винесено на аукціон";
    include_once '../Views/InfoForUserView.php';
}

if (isset($_POST["bet"]))
{
    $auction->makeBet($_GET['auction_car_id'], $_POST['user_id'], $_POST['bet']);
    header("Refresh:0");
}

if (isset($_GET['auction_car_id']))
{
    $auctionCarInfo = $auction->getItemInfo($_GET['auction_car_id']);

    $id_car = $_GET['auction_car_id'];
    $date = new DateTime();
    $date->setTimestamp($auctionCarInfo['time_end']);

    $car = $item->getItemCarById($id_car);
    include_once '../Views/AuctionCarPageView.php';
}

if (isset($_GET['main_page']))
{

    include_once '../Views/AuctionMainPageParts.php';
    showHeader();

    foreach ($auction->getAllAuctionCar() as $row)
    {
        $auctionCarInfo = $auction->getItemInfo($row['id_item']);
        $car = $item->getItemCarById($row['id_item']);



        $date = new DateTime();
        $date->setTimestamp($auctionCarInfo['time_end']);

        include '../Views/AuctionCarPreview.php';

    }

    showFooter();

}


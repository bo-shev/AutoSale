<?
    echo $_POST['auctionend'];
    echo '<br>';
    echo strtotime($_POST['auctionend']);
    echo '<br>';
    $time  = strtotime($_POST['auctionend']);
  
    $date = new DateTime();
     $date->setTimestamp($time);
    echo $date->format('F j, Y, H:i:s') . "\n";
    $date = new DateTime();

    echo strtotime( $date->format('F j, Y, H:i:s'));
    //echo $date;
?>


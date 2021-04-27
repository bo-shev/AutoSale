<?

function dellOrder($order_id)
{
    include_once 'conect.php';

     $dbh = conectDb('users');

    //подготовленный запрос
    $smth=$dbh->prepare("DELETE FROM orders WHERE orders.order_id = '$order_id'");

    $smth->execute();
    $dbh = null;
    //
}


if(array_key_exists('order_id',$_POST))
{    
    dellOrder( $_POST['order_id']);
 }

 
include_once 'siteparts/siteHeader.php';
?>
<div class="contentSearchPage regandlog"><br><br><br>

<span>Замовлення успішно видалено!</span>
</div>
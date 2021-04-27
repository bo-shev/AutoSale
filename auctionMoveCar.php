<?
 include_once 'siteparts/siteHeader.php';
 //<div class="contentSearchPage">
echo '<br><br><br><div class=" contentSearchPage search_result regandlog"  >';
    echo '
    <form name="auctionLot" action="auctionInsertCar.php" method="post">
        
        <table border="0" align="center" >
        <tr><td>Початкова ціна</td> <td><input type="number" name="start_price" value="0" min="0" required><td></tr>
        <tr><td>Ціна викупа</td> <td><input type="number" name="top_price" value="0" min="0" required><td></tr>
        <tr><td>Мінімальна ставка</td> <td><input type="number" name="minimal_bet" value="0" min="0" required><td></tr>

        <tr><td>Час закінчення аукціону</td> <td><input name="auctionend" type="datetime-local" required><td></tr>
        </table>
        <input name="dbtype" type="hidden" value='.$_POST['dbtype'].'>
        <input  name="id_car" type="hidden" value='.$_POST['idcar'].'>
        <input type="Submit" name=confirm value=" Винести цей автомобіль на аукціон ">
    </form>';
    echo '</div>'


?>
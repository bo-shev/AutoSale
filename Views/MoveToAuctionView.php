<?php
include_once "../HtmlParts/SiteHeader.php";
echo '<div class=" contentSearchPage  regandlog auctionmoveclass" style = "min-height: 90%;" ><br><br><br><br>    ';

echo '
    <form name="auctionLot" action="../Controllers/AuctionController.php" method="post">
        
        <table border="0" align="center" >
        <tr><td>Початкова ціна</td> <td><input type="number" name="start_price" value="0" min="0" required><td></tr>       
        <tr><td>Мінімальна ставка</td> <td><input type="number" name="minimal_bet" value="0" min="0" required><td></tr>

        <tr><td>Час закінчення аукціону</td> <td><input name="auctionend" type="datetime-local" required><td></tr>
        </table>
        
        <input  name="id_car" type="hidden" value='.$_POST["idcar"].'>
        
        <input type="Submit" name="confirm" value=" Винести цей автомобіль на аукціон ">
    </form>';
echo '</div>';
include_once "../HtmlParts/Footer.php";

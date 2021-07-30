<?php




    echo '<div class="search_result regandlog smallmargin" >';
    echo '<table class=" regandlog"><tr>';
    echo '<td>';

    echo '<img src="../upload/' . $car->getPhoto() . '" alt="Car" style="width:98%; height: 350px;margin-top:6px">';
    echo '</td>';

    echo '<td>';


    echo '<table class=" regandlog"><tr><td><span>Дата закінчення аукціону</span></td></tr>';
    echo '<tr><td><span>' . $date->format('F j, Y, H:i:s') . '</span></td></tr>';

    echo '</table>';

    echo '</td>';

    echo '<td>';

    echo '<div class="Specs specPos">';
    echo '<div class=" smallmargin" >';
    echo '<span>Характеристики:</span>';
    echo '<table border="0" ><tr><td>Рік виготовлення:</td><td>' . $auctionCarInfo["year"] . '</td></tr>';
    echo '<tr><td>Двигун:</td><td>' . $auctionCarInfo["volume"] . ' л</td></tr>';
    echo '<tr><td>Тип пального:</td><td>' . $auctionCarInfo["fuel_type"] . '</td></tr>';
    echo '<tr><td>Потужність:</td><td>' . $auctionCarInfo["horse_power"] . ' кс</td></tr>';
    echo '<tr><td>Пробіг:</td><td>' . $auctionCarInfo["car_mileage"] . 'км</td></tr>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</td>';

    echo '<td>';
    echo '<a href="?auction_car_id=' . $row['id_item'] . '" class=" showpagebutton button right "  >Переглянути сторінку</a>';
    echo '</td>';

    echo '</table>';
    echo '</div>';

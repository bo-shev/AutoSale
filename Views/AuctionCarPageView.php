<?php
include_once "../HtmlParts/siteHeader.php";
echo '<div class="contentSearchPage changecarinfoclass" style = "min-height: 90%;" > ';
echo '<div class="mainPart">';
echo '<div class="baseInfo">';
echo '<span id="currentprice" name="currentprice" class="priceView">Поточна ціна: $'.$auctionCarInfo["current_price"].'</span>';

echo '</div>';

echo '<div style="float:left; margin-right: 10px;">';
include '../Views/galery.php';
echo '</div>';
echo '<div class="search_result regandlog" style="display:inline-block;  ">';
echo '<div style="float:left text-alight:center">';
echo '<span style="font-size:16px">До кінця аукціону:</span><br>';// таймер
echo '<span id="t" style="font-size:16px"></span>';// таймер

echo '<table border="0" align="center" >';
echo '<form  method="post">';
echo '<br>Крок ставки: '.$auctionCarInfo["minimal_bet"].'$';
echo '<input id="id_car" name="id_car" type="hidden" value='.$id_car.'>
                <input name="user_id" type="hidden" value='.$user_info['id'].'>
                <input id="minimal_bet" type="hidden" value='.$auctionCarInfo["minimal_bet"].'>';
echo '<tr><td><input type="number" style="width:98%" name="bet" value="'.$auctionCarInfo["minimal_bet"].'" min="'.$auctionCarInfo["minimal_bet"].'" max ="'.$auctionCarInfo["top_price"].'"   placeholder="'.$auctionCarInfo["minimal_bet"].'" step="'.$auctionCarInfo["minimal_bet"].'" required></td>';
echo '<td> <input type="Submit"   value="Зробити ставку"></td></tr>';
echo '</form>';

echo '</table>';
echo '</div><br>';
if ($auctionCarInfo['winner_id'] == null)
{
    echo "<span>Лідерів аукціону поки що немає</span>";
}
else
{
    echo '<span>Лідер аукціону </span> <br> <table class="regandlog"  border="0" >';
    $auctionWinnerInfo = $auction->getCurrentWinner($id_car);
    echo '<tr><td>Логін лідера аукціону:</td><td>'.$auctionWinnerInfo["user_login"].'</td></tr>';

    echo '<tr><td>Пошта:</td><td>'.$auctionWinnerInfo["user_mail"].'</td></tr>';
    echo '<tr><td>Телефонний номер:</td><td>'.$auctionWinnerInfo["user_number"].'</td></tr>';


    echo '</table>';

}
echo '</div>';

echo ' <div class="descContainer" style="display:block;position: relative;float:left; width:60% "> <span style="width:50%" class="descName">Опис:</span><br><span class = "description">'.$auctionCarInfo['description'].'</span> </div>';

echo '<div class="Specs" style="display:block;position: relative; float:right  ">';
echo '<div  style=margin-left:20px>';
echo '<span>Характеристики:</span>';
echo '<table border="0" ><tr><td>Рік виготовлення:</td><td>'.$auctionCarInfo["year"].'</td></tr>';
echo '<tr><td>Двигун:</td><td>'.$auctionCarInfo["volume"].' л</td></tr>';
echo '<tr><td>Тип пального:</td><td>'.$auctionCarInfo["fuel_type"].'</td></tr>';
echo '<tr><td>Потужність:</td><td>'.$auctionCarInfo["horse_power"].' кс</td></tr>';
echo '<tr><td>Пробіг:</td><td>'.$auctionCarInfo["car_mileage"].'км</td></tr>';
echo '</table>';echo '</div>';
echo '</div>';


echo '</div>';
echo '</div>';

echo '<script type="text/javascript">
        
          timeend=new Date("'.$date->format('F j, Y, H:i:s') .'");
          var timestr ="gfdgdfgdf";
          document.getElementById("t").innerHTML=timestr;
          function time()
          {
              today = new Date();
              
              if (timeend-today > 0)
              {
                  today = Math.floor((timeend-today)/1000);
                  tsec=today%60; today=Math.floor(today/60); if(tsec<10)tsec="0"+tsec;
                  tmin=today%60; today=Math.floor(today/60); if(tmin<10)tmin="0"+tmin;
                  thour=today%24; today=Math.floor(today/24);
                  
                  timestr=today +" днів "+ thour+" годин "+tmin+" хвилин "+tsec+" секунд";
              }
              else
              { timestr="Аукціон закінчено";}
              document.getElementById("t").innerHTML=timestr;
             
              window.setTimeout("time()",1000);
          }
          time();
          </script>';
include_once "../HtmlParts/footer.php";



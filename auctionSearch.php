<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AutoSale</title>

    <link rel="stylesheet" href="mainStyle.css">
    
  
</head>
<br>
<div class = "searchform searchtable" style="text-align: center; display: block ; " >
    <table class = ""style="  margin: auto; "  >
<tr>
    <td><span>Тип аукціонів: </span></td>
    
    <form name="search" action="auctionCarsPage.php" method="post" >
    <td>   <select class="fuelselect" name="auctiontype">
                <option value="all">Всі аукціони</option>
                <option value="current">Поточні аукціони</option>
                <option value="gone">Аукціони що закінчились</option>              
            </select></td>
            <td><input class=""  type="Submit" value="Пошук!"></td>
    
    </form>
    </tr>
    </table>
</div>
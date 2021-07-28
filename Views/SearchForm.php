<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AutoSale</title>

<!--    <link rel="stylesheet" href="../Style/mainStyle.css">-->
    
  
</head>

<form name="search" action="../Controllers/SearchController.php" method="GET" >
<div class = "searchform">
    <table class = "searchtable">
        <tr>
            <td>Марка:</td>
            <td>

                <select class="markselect" name = "brand">
                    <?
                    include_once "../Controllers/SearchController.php";

                    $search = new SearchCarController;
                    echo '<option value="0">------</option>';
                    foreach($search->sendBrandToView() as $row)
                    {
                        echo '<option value='.$row["brand"].'>'.$row["brand"].'</option>';
                    }
                    ?>

                </select>
            </td>
            <td>Паливо:</td>
            <td>
                <select class="fuelselect" name="fuel">
                <option value="0">-----</option>
                    <option value="petrol">Бензин</option>
                    <option value="diesel">Дизель</option>
                    <option value="electric">Електро</option>
                </select>
            </td>

            <td>Пробіг, км:</td>
            <td>
                <input type="number" class = "distancefrom" min="0" max="100000000" placeholder="Від" name="mindistance">
                <input type="number" class = "distanceto" min="0" max="100000000" placeholder="До" name="maxdistance">
            </td>
        </tr>
        <tr>
            <td>Модель:</td>
            <td>
                <select class="modelselect" name="model">

                <?
                $search = new SearchCarController;

                echo '<option value="0">------</option>';
                foreach($search->sendModelsToView() as $row)
                {
                    echo '<option value='.$row["model"].'>'.$row["model"].'</option>';
                }

                    ?>

                </select>
            </td>
            <td>Потужність, кс:</td>
            <td>
                <input type="number" class = "powerfrom" min="0" max="100000" placeholder="Від" name="minpower">
                <input type="number" class = "powerto" min="0" max="100000" placeholder="До" name="maxpower">
            </td>
            <td>Рік випуску:</td>
            <td>
                <select class="yearfrom" name="minyear">
                    <script>
                        for(i=1950;i < new Date().getFullYear(); i++)
                            document.write("<option>" + i + "</option>")
                    </script>
                </select>
                <select class="yearto" name="maxyear">
                    <script>
                        for(i=new Date().getFullYear();i > 1950; i--)
                            document.write("<option>" + i + "</option>")
                    </script>
                </select>
            </td>
        </tr>
        <tr>
            <td>Ціна, $:</td>
            <td>
                <input type="number" class = "costfrom" min="0" max="100000000" placeholder="Від" name="minprice">
                <input type="number" class = "costto" min="0" max="100000000" placeholder="До" name="maxprice">
            </td>

            <!--            <td>Стан:</td>-->
<!--            <td>-->
<!--                <select class="stateselect" name="car_condition">-->
<!--                <option value="0">-----</option>-->
<!--                <option value="used">Б\У</option>-->
<!--                    <option value="new">Нова</option>-->
<!--                </select>-->
<!--            </td>-->
            <td>Об'єм двигуна:</td>
            <td>
                <input type="number" class = "volumefrom" min="0" max="100" placeholder="Від" name="minvalue">
                <input type="number" class = "volumeto" min="0" max="100" placeholder="До" name="maxvalue">
            </td>
            <td></td>
            <td class="searchbutton" >

                <a href="javascript: submitform()" ><div>Пошук! </div></a>


            </td>
        </tr>

    </table>

</div>
</form>

<script type="text/javascript">
function submitform()
{
    document.forms["search"].submit(); 
}
</script>
var ajax; // глобальная переменная для хранения объекта AJAX
InitAjax();
function InitAjax() 
{
    try
    { /* пробуем создать компонент XMLHTTP для IE старых версий */
    ajax = new ActiveXObject("Microsoft.XMLHTTP");
    } 
catch (e)
    {
        try
        {
        ajax = new ActiveXObject("Msxml2.XMLHTTP"); // для IE версий >6
        }
    catch (e) 
        {
            try {// XMLHTTP для Mozilla и остальных
            ajax = new XMLHttpRequest(); // на текущий момент можно ограничится этим вызовом
            } catch(e) { ajax = 0; }
        }
    }
}

function changeInfo()
 {
    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    var brand = document.getElementById("brand").value;
    var model = document.getElementById("model").value;
    var price = document.getElementById("price").value;
    var year = document.getElementById("year").value;
    var hp = document.getElementById("hp").value;
    var volume = document.getElementById("volume").value;
    var distance = document.getElementById("distance").value;
    var car_condition = document.getElementById("carcondition").value;
    var fuel = document.getElementById("fuel").value;
    var description = document.getElementById("description").value;
    var id_car = document.getElementById("idcar").value;
    var dbtype = document.getElementById("dbtype").value;
    ajax.onreadystatechange = UpdateInfo;
    var param1 = 'brand=' + encodeURIComponent(brand);
    var param2 = 'model=' + encodeURIComponent(model);
    var param3 = 'price=' + encodeURIComponent(price);
    var param4 = 'year=' + encodeURIComponent(year);
    var param5 = 'hp=' + encodeURIComponent(hp);
    var param6 = 'volume=' + encodeURIComponent(volume);
    var param7 = 'distance=' + encodeURIComponent(distance);
    var param8 = 'carcondition=' + encodeURIComponent(car_condition);   
    var param9 = 'fuel=' + encodeURIComponent(fuel);
    var param10 = 'description=' + encodeURIComponent(description);
    var param11 = 'idcar=' + encodeURIComponent(id_car);
    var param12 = 'dbtype=' + encodeURIComponent(dbtype);
    ajax.open("GET", "script/updateInfo.php?"+param1+"&"+param2+"&"+param3+"&"+param4+"&"+param5+"&"+param6+"&"+param7+"&"+param8+"&"+param9+"&"+param10+"&"+param11+"&"+param12, true);
    ajax.send(null);
}

function UpdateInfo()
 {
    if (ajax.readyState == 4) 
    {
        if (ajax.status == 200) 
        {
        // если ошибок нет
        var text = document.getElementById('confirmed');
        text.innerHTML = ajax.responseText;
        }
   
    }
}

function getWinner()
{
    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    
    var id_car = document.getElementById("id_car").value;
    var user_id = document.getElementById("user_id").value;
    var bet = document.getElementById("bet").value;
    var minimal_bet = document.getElementById("minimal_bet").value;
    if (minimal_bet > bet)
    {
        alert("Ваша ставка занизька, мінімальна ставка: "+minimal_bet);
    }
    ajax.onreadystatechange = updateWinner;
    var param1 = 'id_car=' + encodeURIComponent(id_car);
    var param2 = 'user_id=' + encodeURIComponent(user_id);
    var param3 = 'beeet=' + encodeURIComponent(bet);
    
    ajax.open("GET", "script/increaseBet.php?"+param1+"&"+param2+"&"+param3, true);
    ajax.send(null);

}

function updateWinner()
{
    if (ajax.readyState == 4) 
    {
        if (ajax.status == 200) 
        {
        // // если ошибок нет
        // var text = document.getElementById('confirmed');
        // text.innerHTML = ajax.responseText;
        }
   
    }
}
    

function getCurrentPrice(idCar)
{
    if (!ajax)
     {
    alert("Ajax не инициализирован"); return;
    }
    
    ajax.onreadystatechange = updateCurrentPrice;
    var param1 = 'id_car=' + encodeURIComponent(idCar);
        
    ajax.open("GET", "script/getCurrentPrice.php?"+param1, true);
    ajax.send(null);

}

function updateCurrentPrice()
{
    if (ajax.readyState == 4) 
    {
        if (ajax.status == 200) 
        {
        // если ошибок нет
        var text = document.getElementById('currentprice');
        text.innerHTML = "Поточна ціна: $"+ajax.responseText;
        }
   
    }
}
    

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

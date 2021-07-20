<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AutoSale</title>

    <link rel="stylesheet" href="../Style/mainStyle.css">
<!--    <script src="changeLanguage.js"></script>-->
</head>

<body>

<header>
    <nav class="mainHead">

        <ul class="topmenu">
            <a href="../Controllers/SearchController.php"> <img class ="logoclass" src="../img/logo.png" alt="logo" width="140vw" height="76vh"   ></a>
                        
            <ul class = "buttons">
                <li class="sitename"><a href="../Controllers/SearchController.php">AutoSale</a></li>
                <li><a href="https://salo0n/auctionCarsPage.php"><span id="auction">Аукціон</span></a></li>
                <li><a href="https://ru.wikipedia.org/wiki/Ошибка_404"><span id="newcars">Нові авто</span></a></li>
                <li><a href="https://ru.wikipedia.org/wiki/Ошибка_404"><span id="weektop">Вибір тижня</span></a></li>
            </ul>

            <div class="rightalign">
                
                <ul class="langmenu">
                    <li><a href="#ukr" data-reload name="data-reload" onclick="setTimeout(() => location.reload(), 200)"><img src="../img/ukr.png" height="16vh"></a></li>
                    <li><a href="#rus" data-reload name="data-reload" onclick="setTimeout(() => location.reload(), 200)" ><img src="../img/rus.png" height="16vh"></a></li>
                    <li><a href="#eng" data-reload name="data-reload" onclick="setTimeout(() => location.reload(), 200)"><img src="../img/eng.png" height="16vh"></a></li>
                </ul>
                
                <ul class = "borderedbuttons">
                   <?php
                        include_once "../Views/userPartView.php";
                   ?>
                    
                    
                </ul>


            </div>
            
        </ul>
    </nav>
</header>


<!-- <p id="temp" style="position: relative;"> Default</p>-->



</body> 

<!--<script>-->
<!--    // setTimeout(() => , 500);-->
<!--    changeText();-->
<!--    var dataReload = document.getElementsByName("data-reload");-->
<!--    for (let i = 0; i < dataReload.length; i++)-->
<!--    {-->
<!--        if ( dataReload[i].onclick == true) {-->
<!--            setTimeout(() => location.reload(), 200); //function () { location.reload();}-->
<!--        }-->
<!--    }-->
<!-- </script>-->
</html>
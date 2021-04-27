<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AutoSale</title>

    <link rel="stylesheet" href="mainStyle.css">
    <script src="changeLanguage.js"></script>
</head>

<body>

<header>
    <nav class="mainHead">

        <ul class="topmenu">
            <img class ="logoclass" src="img/logo.png" alt="logo" width="140vw" height="76vh"   >
                        
            <ul class = "buttons">
                <li class="sitename"><a href="http://salo0n/carsPage.php">AutoSale</a></li>
                <li><a href="https://ru.wikipedia.org/wiki/Ошибка_404"><span id="auction">Аукціон</span></a></li>
                <li><a href="https://ru.wikipedia.org/wiki/Ошибка_404"><span id="newcars">Нові авто</span></a></li>
                <li><a href="https://ru.wikipedia.org/wiki/Ошибка_404"><span id="weektop">Вибір тижня</span></a></li>
            </ul>

            <div class="rightalign">
                
                <ul class="langmenu">
                    <li><a href="#ukr" data-reload name="data-reload" onclick="setTimeout(() => location.reload(), 200)"><img src="img/ukr.png" height="16vh"></a></li>
                    <li><a href="#rus" data-reload name="data-reload" onclick="setTimeout(() => location.reload(), 200)" ><img src="img/rus.png" height="16vh"></a></li>
                    <li><a href="#eng" data-reload name="data-reload" onclick="setTimeout(() => location.reload(), 200)"><img src="img/eng.png" height="16vh"></a></li>
                </ul>
                
                <ul class = "borderedbuttons">
                    <?
                        include_once 'usercheck.php';
                        //echo '<li class = "sellauto"><a href="#">'.checkUser().'</a></li>';
                         if (checkUser() != false)
                         {
                             $user_info = checkUser();
                             switch ($user_info['role']) {
                                 case 'user':
                                    echo '<li class = "sellauto"><a href="http://salo0n/addUserCar.php">Продати авто</a></li>'; 
                                     break;
                                 case 'moder':
                                   echo '<li class = "sellauto"><a href="http://salo0n/usersCarPage.php">Переглянути заявки</a></li>'; 
                                      break;
                                case 'admin':
                                   echo '<li class = "sellauto"><a href="http://salo0n/usersPage.php">Список користувачів</a></li>'; 
                                      break;
                             }
                             
                            echo '<li class = "sellauto"><a href="http://salo0n/userAbility.php">'.$user_info["user_login"].'</a></li>';   
                            echo '<li class = "sellauto"><a href="logout.php">Вийти</a></li>';                   
                         }
                         else
                         {echo '<li class = "login"><a href="login.php">Авторизація</a></li>';}

                    ?>
                    
                    
                </ul>


            </div>
            
        </ul>
    </nav>
</header>


 <p id="temp" style="position: relative;"> Default</p>



</body> 

<script>
    // setTimeout(() => , 500);
    changeText();
    var dataReload = document.getElementsByName("data-reload");
    for (let i = 0; i < dataReload.length; i++)
    {
        if ( dataReload[i].onclick == true) {
            setTimeout(() => location.reload(), 200); //function () { location.reload();}
        }
    }
 </script>  <!-- Ця функція має викликатись ОБОВ'ЯЗКОВО після тексту з перекладом -->
</html>
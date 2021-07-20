<?php
    include_once "../Models/Users.php";

    $user = new User();
    $user_info = 0;

     if ($user->isAuthorized())
     {
         $user_info = $user->getUserInfoArr();
         switch ($user_info['role'])
         {
             case 'user':
                echo '<li class = "sellauto"><a href="../Controllers/SearchController.php">Придбати авто</a></li>';
                 break;

            case 'admin':
               echo '<li class = "sellauto"><a href="../Controllers/AllUserController.php">Список користувачів</a></li>';
                  break;
         }

        echo '<li class = "sellauto"><a href="../Views/UserAbilitesView.php">' .$user_info["userLogin"].'</a></li>';
        echo '<li class = "sellauto"><a href="../Controllers/LogOutController.php">Вийти</a></li>';
     }
     else
     {echo '<li class = "login"><a href="../Controllers/AuthorizationController.php">Авторизація</a></li>';}

?>

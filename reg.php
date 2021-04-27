<?
// Страница регистрации нового пользователя

// Соединямся с БД
$link=mysqli_connect("localhost", "root", "root", "users");

if(isset($_POST['submit']))
{
    $err = [];

    //перевірка номеру

    $pattern = "/^\+380\d{3}\d{2}\d{2}\d{2}$/";
    if(preg_match($pattern, $_POST['number'])) 
    {
        $err[] =  "Номер не валідний";
    }
    //перевірка пошти
    if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) 
    {
        $err[] = "E-mail адрес ".$_POST['mail']." указан неверно";
    } 
   
    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['login'];

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));

        mysqli_query($link,"INSERT INTO users SET user_mail='".$_POST['mail']."', user_login='".$login."', user_password='".$password."', user_number='".$_POST['number']."', role='user'");
        echo '<a href="http://salo0n/carsPage.php">Реєстрація пройшла успішно, повернутися на головну</a>';

         exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}

include_once "siteParts/siteHeader.php";
?>
<div class="contentSearchPage">
<div class= "regandlog" style="top: 60px; display: block; position: relative; " >

<form method="POST">
Логин <input name="login" type="text" required><br>
Пароль <input name="password" type="password" required><br>
Пошта <input name="mail" type="text" required><br>
Номер телефону <input name="number" type="text" value="+38 (999) 999-99-99" required><br>
<input name="submit" type="submit" value="Зарегистрироваться">
</form>
</div>
</div>
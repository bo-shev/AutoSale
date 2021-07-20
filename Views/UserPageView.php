<?php
include_once "../HtmlParts/siteHeader.php";

if ($user_info['role'] == "admin")
{
    echo '<br><br><br><div class="contentSearchPage regandlog" style = "min-height: 90%;"><br><br><br>';

    echo '<span>Інформація про користувача:</span>';
    echo '<table border="0" ><tr><td>Логін користувача:</td><td>'.$userPageInfo["userLogin"].'</td></tr>';
    echo '<tr><td>Пошта:</td><td>'.$userPageInfo["userMail"].'</td></tr>';
    echo '<tr><td>Телефонний номер:</td><td>'.$userPageInfo["userNumber"].'</td></tr>';
    echo '<tr><td>Індифікатор користувача:</td><td>'.$userPageInfo["id"].'</td></tr>';
    echo '<tr><td>Роль користувача:</td><td>'.$userPageInfo["role"].'</td></tr>';

    echo '</table>';

    if (array_key_exists('new_role', $_POST))
    {
        $user->changeRole($_POST['new_role'], $userPageInfo["id"]);
    }
}
else
{
    echo '<div class="searchbutton regandlog" >';
    echo '<a href="../Controllers/SearchController.php">Ви немаєте доступу до цієї інформації, повернутися до пушуку товарів?</a>';
    echo '</div><br>';
}

echo '<div class="contentSearchPage regandlog useredit">
    <span>Зміна ролі користувача:</span>
    <form action="../Controllers/UserPageController.php?id='.$_GET['id'].'" method="POST">
        <select name="new_role" >
            <option value = "user">user</option>           
            <option value = "admin">admin</option>
        </select>

        <input name="submit" type="submit" value="Змінити">
    </form>
</div>
</div>';

include_once "../HtmlParts/footer.php";
?>
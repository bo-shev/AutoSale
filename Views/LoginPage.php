<?php
    include_once "../HtmlParts/SiteHeader.php";
?>
<div class="contentSearchPage pageheight" ">
    <div class= "regandlog loginclass loginpos"  >
        <span><?php echo $errorText; ?></span>
        <form method="POST">
            <tr>
                <td>Логiн</td> <td><input name="login" type="text" required></td><br>
            </tr><tr>
                <td>Пароль</td> <td><input name="password" type="password" required></td></tr><br>
            <input name="submit" type="submit" value="Войти">
        </form>
        </table>
        <a href="../Controllers/RegistrationController.php">Реєстрація</a>
    </div>
</div>
<?php
    include_once "../HtmlParts/Footer.php";
?>

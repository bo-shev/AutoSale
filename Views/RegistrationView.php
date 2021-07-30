
<?php
    include_once "../HtmlParts/SiteHeader.php";
?>

<div class="contentSearchPage pageheight" >
    <div class= "regandlog registerclass loginpos"  >
        <?php

            if (isset($_POST['login']))
            {
                $userRegistration = new Registration($_POST['login'], $_POST['mail'], $_POST['password'], $_POST['number']);

                if ($userRegistration->createNewUser())
                {
                    echo "Реєстація пройшла успішно";
                }
                else
                {
                    foreach ( $userRegistration->getErrors() as $row)
                    {
                        echo $row."<br>";
                    }
                }
            }
            include_once "../HtmlParts/RegistrationForm.php";

        ?>

    </div>
</div>

<?php
    include_once '../HtmlParts/Footer.php';
?>

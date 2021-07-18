
<?php
    include_once "../HtmlParts/siteHeader.php";
?>

<div class="contentSearchPage" style= " min-height: 90%;">
    <div class= "regandlog registerclass" style="top: 60px; display: block; position: relative; " >
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
            include_once "../HtmlParts/registrationForm.php";

        ?>

    </div>
</div>

<?php
    include_once '../HtmlParts/footer.php';
?>

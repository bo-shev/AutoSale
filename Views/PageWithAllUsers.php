<?php
include_once "../HtmlParts/SiteHeader.php";
echo '<br><br>';

echo '<div class="contentSearchPage regandlog" style = "min-height: 90%;"><br><br><br>';

if ($user_info['role'] == "admin")
{
    foreach ($usersArr as $row)
    {
        $user = $row->getUserInfoArr();
        echo '<div class="searchbutton regandlog" >';
        echo '<a href="../Controllers/UserPageController.php?id='.$user["id"]. '">';
        echo $user["userLogin"];
        echo '</a>';
        echo '</div><br>';
    }
}
else
{
    echo '<div class="searchbutton regandlog" >';
    echo '<a href="../Controllers/SearchController.php">Ви немаєте доступу до цієї інформації, повернутися до пушуку товарів?</a>';
    echo '</div><br>';
}
echo '</div>';

include_once "../HtmlParts/Footer.php";
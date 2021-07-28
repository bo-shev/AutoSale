<?php
function showHeader()
{
    include_once "../HtmlParts/SiteHeader.php";
    echo '<div class="contentSearchPage changecarinfoclass"  style = "min-height: 90%;"> <br><br><br><br><br><br>';

}

function showFooter()
{
    echo '</div>';
    include_once "../HtmlParts/Footer.php";
}
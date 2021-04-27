<?

include_once 'siteparts/adminonly.php';
include_once 'siteparts/siteHeader.php';

echo '<div class="contentSearchPage regandlog"><br><br><br>';

include_once 'conect.php';
include_once 'userPreview.php';
$dbh = conectDb('users');

$sql = "SELECT users.user_id FROM users";
    foreach($dbh->query($sql) as $row)
        {
            userPreview($row['user_id']);
        }


echo '</div>'
?>
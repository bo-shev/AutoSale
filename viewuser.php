<?
 include_once 'siteparts/adminonly.php';
 session_start();
include_once 'siteparts/siteHeader.php';

echo '<div class="contentSearchPage regandlog"><br><br><br>';
$user_id = 12;
include_once 'conect.php';
function viewUser($user_id)
{
   
   // echo $user_id.'<br>';
    $dbh = conectDb('users');

    $sql = "SELECT * FROM users WHERE users.user_id = '$user_id'"; 

    foreach($dbh->query($sql) as $row)
    {
        echo '<span>Інформація про користувача:</span>';
            echo '<table border="0" ><tr><td>Логін користувача:</td><td>'.$row["user_login"].'</td></tr>';
            echo '<tr><td>Пошта:</td><td>'.$row["user_mail"].'</td></tr>';
            echo '<tr><td>Телефонний номер:</td><td>'.$row["user_number"].'</td></tr>';
            echo '<tr><td>Індифікатор користувача:</td><td>'.$row["user_id"].'</td></tr>';
            echo '<tr><td>Роль користувача:</td><td>'.$row["role"].'</td></tr>';
           
            echo '</table></div>';
    }
    $dbh = null;
}



function changeRole($new_role, $user_id)
{
    //include_once 'conect.php';
    $dbh = conectDb('users');
    $sql = "UPDATE USERS SET ROLE = '$new_role' WHERE users.user_id = '$user_id'";
    $dbh->query($sql);

   //  viewUser($_POST['id_user']);
}

//viewUser($user_id);
if(array_key_exists('id_user',$_POST))
{
    global $user_id;
    $user_id= $_POST['id_user'];
    $_SESSION["id_user"] = $user_id;
    viewUser($user_id);
 }
else
{
    global $user_id;
    $user_id = $_SESSION["id_user"];
    //echo $_SESSION["id_user"];
    viewUser($user_id);
}

if(isset($_POST['submit']))
{
    global $user_id;
    changeRole( $_POST['role'], $user_id);
}
echo '</div>';
?>
<div class="contentSearchPage regandlog">
<span>Зміна ролі користувача:</span>
<form method="POST">
<select name='role' >

  <option value = 'user'>user</option>
  <option value = 'moder'>moder</option>
  <option value = 'admin'>admin</option>
</select>

<input name="submit" type="submit" value="Змінити">
</form>



</div>
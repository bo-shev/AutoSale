<?
function userPreview($user_id)
{
    echo '<a href="javascript: submitMy('.$user_id.')">';
    echo '<form class="search_result" name="form'.$user_id.'" action="viewuser.php" method="post">';
    echo '<input type="hidden" name="id_user" value='.$user_id.' />';
      


        include_once 'conect.php';
        $dbh = conectDb('users');

        $sql = "SELECT * FROM users WHERE users.user_id = '$user_id'"; 
        echo '<a href="javascript: submitMy('.$user_id.')">';
        foreach($dbh->query($sql) as $row)
        {
            echo '<div class="searchbutton regandlog" >'.$row["user_login"].'</div>'; 
            echo '<br>';
        } echo '</a>';
        
        
    echo '</form>';
   
}


?>

<script type="text/javascript">
  function submitMy(formNumb)
  {
      document.forms["form"+formNumb].submit(); 
  }</script>
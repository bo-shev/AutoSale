
<?
function previewCar($id_car)
{
    
echo '
<style>

/* Display the columns below each other instead of side by side on small screens */

    .column {
        width: 100%;
        display: block;
        padding: 0 8px;
        margin-bottom: 16px;
    }


/* Add some shadows to create a card effect */
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

/* Some left and right padding inside the container */
.container {
    padding: 0 16px;
}

/* Clear floats */
.container::after, .row::after {
    content: "";
    clear: both;
    display: table;
}




.price
{
    display: block;
    float: right;
}

.button:hover {
    background-color: #555;
}
</style>




<form name="myform'.$id_car.'" action="vievcar.php" method="post">
    <input type="hidden" name="test" value='.$id_car.' /><br/>
    <a href="javascript: submitMy('.$id_car.')">


';



//include_once 'vievcar.php' ;
echo' 
<div class="column">
    <div class="card">
    ';
     include_once 'conect.php';

     $dbh = conectDb('car');

     $sql = "SELECT pach_poto FROM photos WHERE fid_car = '$id_car'";//$id_car

     foreach($dbh->query($sql) as $row)
         {
            echo '<img src='.$row["pach_poto"].' alt="Car" style="width:100%">';
            break;
         }
 

         $sql = "SELECT * FROM car WHERE car.id_car = '$id_car'"; //$id_car

         echo '<div class="container">';
         foreach($dbh->query($sql) as $row)
         {
             echo '<span>'.$row["brand"].' '.$row["model"].'</span> ';
             echo '<span class="price">$'.$row["price"].'</span>';
         } 
    $dbh = null;
    
      echo '
      </a></form>
      <script type="text/javascript">
function submitMy(formNumb)
{
    document.forms["myform"+formNumb].submit(); 
}
</script>
        <!-- <h2>Mike Ross</h2>
        <p class="title">Art Director</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>example@example.com</p>
        <p><button class="button">Contact</button></p> -->
      </div>
    </div>
  </div>';
        }
  ?>
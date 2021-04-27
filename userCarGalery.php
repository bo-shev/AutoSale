<!-- Container for the image gallery -->

<style>
   
     
   body {
    font-family: Arial;
    margin: 0;
  }
  
  * {
    box-sizing: border-box;
  }
  
  img {
    vertical-align: middle;
  }
  
  /* Position the image container (needed to position the left and right arrows) */
  .container {
      display: inline-block;
      position: relative;
      width: 600px;
      border: #7e7e7e 1px solid;
      padding: 3px;
      margin-left: 10px;
  }
  
  /* Hide the images by default */
  .mySlides {
    display: none;
  }
  
  /* Add a pointer when hovering over the thumbnail images */
  .cursor {
    cursor: pointer;
  }
  
  /* Next & previous buttons */
  .prev,
  .next {
    cursor: pointer;
    position: absolute;
    top: 40%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
  }
  
  /* Position the "next button" to the right */
  .next {
    right: 0;
    border-radius: 3px 0 0 3px;
  }
  
  /* On hover, add a black background color with a little bit see-through */
  .prev:hover,
  .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }
  
  /* Number text (1/3 etc) */
  .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
  }
  
  /* Container for image text */
  .caption-container {
    text-align: center;
    background-color: #222;
    padding: 2px 16px;
    color: white;
  }
  
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  
  /* Six columns side by side */
  .column {
    float: left;
    width: 16.66%;
  }
  
  /* Add a transparency effect for thumnbail images */
  .demo {
    opacity: 0.6;
  }
  
  .active,
  .demo:hover {
    opacity: 1;
  }
  
  .contentViewPage
  {
      background-color: rgba(10, 10, 10, 0.6);
      display: block;
      width: 1000px;
      margin-left: auto;
      margin-right: auto;
      border-left: #cbcbcb 1px solid;
      border-right: #cbcbcb 1px solid;
  }
  
  .mainPart
  {
      margin-top:6vh;
      padding-top: 2vh;
      padding-bottom: 4.5vh;
  }
  
  .baseInfo
  {
      border-bottom: #727272 1px solid;
      margin-bottom: 5px;
      padding-bottom: 5px;
  }
  
  .carNameView
  {
      font-family: Century Gothic, serif;
      font-size: 40px;
      margin-left: 10px;
      color: #e2e2e2;
  }
  
  .priceView
  {
      font-family: Century Gothic, serif;
      font-size: 40px;
      color: #9bff89;
      float: right;
      margin-right: 10px;
  }
  
  .imagesSpecs
  {
      padding-bottom: 5px;
      border-bottom: #727272 1px solid;
  }
  
  .Specs
  {
      display: inline-block;
      position: absolute;
      font-family: Century Gothic, serif;
      font-size: 30px;
      color: #d6d6d6;
      margin: 10px 15px;
  }
  
  .Specs td
  {
      font-family: Century Gothic, serif;
      font-size: 20px;
      color: #d6d6d6;
      padding-right: 15px;
  }
  
  .descName
  {
      font-family: Century Gothic, serif;
      font-size: 30px;
      color: #d6d6d6;
      margin-left: 10px;
  }
  
  .description
  {
      font-family: Century Gothic, serif;
      font-size: 20px;
      color: #d6d6d6;
      margin-left: 10px;
  }
  
  .descContainer
  {
      margin: 10px 20px;
  }
  
  .buyButton
  {
      display: inline-block;
      position: absolute;
      margin-top: 450px;
      border: #a9ff7a 1px solid;
      padding: 15px;
      margin-left: 100px;
      background-color: #1a1a1a;
  }
  
  .buyButton a
  {
      font-family: Century Gothic, serif;
      font-size: 20px;
      color: #87be70;
      text-decoration: none;
  }
  
  .buyButton a:hover
  {
      color: #d5ffba;
  }
  </style>
<?
function createGallery($id_car)
{
//$id_car =2;
echo '
<head>
 <meta charset="UTF-8">
 <title>gallery</title>
 
 <!-- <link rel="stylesheet" type="text/css" href="galery/style.css">
 -->

</head>
<body>
<div class="container">

  <!-- Full-width images with number text -->
';

    include_once 'conect.php';
    $dbh = conectDb('car');

    $sql = "SELECT users_photos.pach_poto FROM users_photos WHERE users_photos.fid_car = $id_car"; //$id_car

    $i = 1;

    
    foreach ($dbh->query($sql) as $row) 
    {   echo '<div class="mySlides">';
        echo '<div class="numbertext">'.$i.'</div>
          <img src='.$row['pach_poto'].' id="myImg" style="width:100%">
        </div>';

        
        $i++;
    }
    

    //$dbh = null; 
    $i = 1;
echo '



  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>

  <!-- Image text -->
 

  <!-- Thumbnail images -->
';

    
    echo '<div class="row">';
    $currentSlide = 1;

    foreach ($dbh->query($sql) as $row) 
    {
      echo '<div class="column">
      <img class="demo cursor" src='.$row["pach_poto"].' style="width:100%" onclick="currentSlide('.$currentSlide.')" alt="car">
    </div>'  ;
    $currentSlide++;
    }
    $dbh = null;
echo '
</div> 
</div> 
 
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
</body>
';
}
?>
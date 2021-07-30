<!-- Container for the image gallery -->


<?
include 'GaleryStyle.php';
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
//
//    include_once 'conect.php';
//    $dbh = conectDb('car');
//
//    $sql = "SELECT photos.pach_poto FROM photos WHERE photos.fid_car = $id_car"; //$id_car

    $i = 1;

    
    foreach ($car->getPhotos() as $row)
    {   echo '<div class="mySlides">';
        echo '<div class="numbertext">'.$i.'</div>
          <img src="../upload/'.$row.'" id="myImg" style="width:100%">
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

    foreach ($car->getPhotos() as $row)
    {
      echo '<div class="column">
      <img class="demo cursor" src="../upload/'.$row.'" style="width:100%" onclick="currentSlide('.$currentSlide.')" alt="car">
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

?>
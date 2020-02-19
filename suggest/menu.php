<html>
  <link rel="stylesheet" href="./suggest/menu.css">
  <script>
    function poster(idmovie){
        document.getElementById('poster_img').innerHTML = "<iframe style='width:100%; height:100%; ' src='./suggest/poster.php?idmovie=" + idmovie + "'  >";

    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="./suggest/script_movie.js"></script>

  <body>
    <div id="poster_img" ></div>
  <!--  <div id="suggest">-->
      <div id="listItem" class="row" style="background-color:black;">
<?php
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
$sql = $cnnx -> prepare("SELECT title, idmovie, posterurl FROM `MOVIE` ");
$sql -> execute();
$films = $sql -> fetchAll();
foreach($films as $film){
?>



       <div class="item text-center col-xl-2 col-md-3 col-4">
           <img src="<?php print_r($film['posterurl']); ?>" alt="<?php print_r($film['title']); ?>" class="img-fluid rounded" onclick="poster(<?php echo $film['idmovie']; ?>)">
       </div>





<?php  } ?>
      </div>
    </div>
  <body>
</html>

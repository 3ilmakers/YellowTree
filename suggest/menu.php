<html>
  <link rel="stylesheet" href="./suggest/menu.css">
  <script>
    function poster(idmovie){
        document.getElementById('poster_img').style.height = "80%";
        document.getElementById('poster_img').innerHTML = "<iframe style='width:100%; height:700px;border:0px; ' src='./suggest/poster.php?idmovie=" + idmovie + "'  >";
        document.getElementById('listItem').style.height = "20%";
    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="./suggest/script_movie.js"></script>
  <link rel="stylesheet" href="./suggest/style_movie.css">

  <body>
    <div id="poster_img"  >
        <?php if(isset($_GET["idmovie"])) echo "<iframe style='width:100%; height:700px;border:0px; ' src='./suggest/poster.php?idmovie=" . $_GET["idmovie"] . "'  >"; ?>
    </div>
  <!--  <div id="suggest">-->
      <div id="listItem" class="row" style="background-color:black; overflow-x: auto;">


<?php
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
if(!isset($_GET['search'])) {
  $sql = $cnnx -> prepare("SELECT title, idmovie, posterurl FROM `MOVIE` ");
  $sql -> execute();
} else {
  $search = "%" . $_GET['search'] . "%";
  $search = str_replace(" ", "%", $search);
  $sql = $cnnx -> prepare("SELECT * FROM `MOVIE` where title like :title or genre like :genre  or director like :director ");
  $sql->execute([':title' =>  $search, ':genre' =>  $search, ':director' =>  $search]);
}


$films = $sql -> fetchAll();
foreach($films as $film){
?>
<div class="item text-center col-xl-2 col-md-3 col-4">
           <img src="<?php print_r($film['posterurl']); ?>" alt="<?php print_r($film['title']); ?>" class="img-fluid rounded " onclick="poster(<?php echo $film['idmovie']; ?>)">
       </div>
<?php } 

echo "<div style='position:relative; width:100%; text-align:center'><h3>Autres resultats</h3></div><br>";
require_once './search_engine/dbmotor.php';
$Scnnx = new motor();
$films = $Scnnx->search_presentation($_GET['search']);
$Scnnx->kill();

if(sizeof($films)==0) include("./suggest/not_found.php");

foreach($films as $filmo){
	foreach($filmo as $film) {
		
?>



       <div class="item text-center col-xl-2 col-md-3 col-4">
           <img src="<?php print_r($film['posterurl']); ?>" alt="<?php print_r($film['title']); ?>" class="img-fluid rounded " onclick="poster(<?php echo $film['idmovie']; ?>)">
       </div>





<?php  } } ?>

      </div>
    </div>
  <body>
</html>

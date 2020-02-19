<html>
  <link rel="stylesheet" href="./suggest/menu.css">
  <body>
    <div id="suggest">
<?php
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
$sql = $cnnx -> prepare("SELECT title, posterurl FROM `MOVIE` ");
$sql -> execute();
$films = $sql -> fetchAll();
foreach($films as $film){
?>

  <div class="sep-sugg">
    <div class="suggfilm">
      <img src="<?php print_r($film['posterurl']); ?>" alt="<?php print_r($film['title']); ?>"></img>

    </div>
  </div>


<?php  } ?>
    </div>
  <body>
</html>

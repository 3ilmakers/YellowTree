<!DOCTYPE html>
<html>
    <head></head>
    <body>

<?php 
function display($poster , $title , $synopsis , $runtime , $genre , $director, $production, $releaseyear){
    echo  "<div class = \"container\" style= \" background-image: url('$poster');  
     background-repeat: no-repeat; background-size : cover; margin-top = 50px;\">
    <div style=\"margin-top = 50px;\" class = \"container\" width=\"100%\" height=\"300px\">
    </div>
    <div style= \" background-color: #FFEF3E;\"  class = \"container\" width=\"100%\" height=\"600px\">
        <h3> $title </h3>
        <p> $releaseyear </p>
    
    </div>

    
    </div>";
}

$searchtxt = $_GET['search'];
$searchtxt = "%".$searchtxt."%";
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
$sql = $cnnx -> prepare("SELECT * FROM movie Where title like :searchtext");
$sql -> execute([':searchtext' => $searchtxt]);
$movies = $sql -> fetchAll();
foreach($movies as $movie){
    $poster = $movie['posterurl'];
    $title = $movie['title'];
    $synopsis = $movie['synopsis'];
    $runtime = $movie['runtime'];
    $genre = $movie['genre'];
    $director = $movie['director'];
    $production = $movie['production'];
    $releaseyear = $movie['releaseyear'];
    display($poster , $title , $synopsis , $runtime , $genre , $director, $production, $releaseyear);
    echo "<hr>";

    
}
?>
</body>
</html>

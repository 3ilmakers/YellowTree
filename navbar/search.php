<?php
$searchtxt = $_GET['search'];
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','admin','root');
$sql ="SELECT * FROM `movie` WHERE title = '/*$searchtxt*'/ ";);
foreach($cnnx -> $sql as $row){

}

?>


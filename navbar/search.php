<?php
$searchtxt = $_GET['search'];
$searchtxt = "%".$searchtxt."%";
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
$sql = $cnnx -> prepare("SELECT * FROM movie Where title like :searchtext");

?>


<?php

$type = $_POST['type'];
$username = $_POST['username'];


$changedtype = "";
if($type == "admin"){
  $changedtype = "user";
}
else{
  $changedtype ="admin";
}

$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost', 'yellowtree', 'yellow');
$sql = $cnnx->prepare("UPDATE USERS SET type = :type WHERE username = :username");
$sql -> execute([':type' => $changedtype ,':username' => $username]);
$cnnx = null;
echo $username." was updated to ".$changedtype;
?>

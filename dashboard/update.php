<?php
session_start();

$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
$sql = $cnnx -> prepare("UPDATE `users` SET `email`= :email,`firstname`= :firstname,`lastname`= :lastname ,`password`= :password WHERE username = :username ");
$sql -> execute([':email' => $email , ':firstname' => $firstname , ':lastname' => $lastname, ':password' => $password]);
header('location : user.php');
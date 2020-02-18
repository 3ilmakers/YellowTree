<?php
$username = $_POST['username'];
$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$type ="user";
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
$sql = $cnnx -> prepare( "INSERT INTO `users` (`username`, `email`, `firstname`, `lastname`, `password`, `type`) VALUES (:username, :email, :firstname, :lastname, :password, :type);");
$sql -> execute([':username' => $username,':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname, ':password' => $password, 'type' => $type]);
header('location: navbar.php');
$cnnx = null ;






?>

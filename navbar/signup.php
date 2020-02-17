<?php
$username = $_POST['username'];
$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$type ="user";
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','admin','root');
$sql = $cnnx -> prepare( "INSERT INTO `users` (`username`, `email`, `firstname`, `lastname`, `password`, `type`) VALUES (:username, :email, :firstname, :lastname, :password, :type)");
$sql -> bindParam(':username', $username, PDO::PARAM_STR);
$sql -> bindParam(':email', $email, PDO::PARAM_STR);
$sql -> bindParam(':firstname', $firstname, PDO::PARAM_STR);
$sql -> bindParam(':lastname', $lastname, PDO::PARAM_STR);
$sql -> bindParam(':password', $password, PDO::PARAM_STR);
$sql -> bindParam(':type', $user, PDO::PARAM_STR );
$sql -> execute();






?>

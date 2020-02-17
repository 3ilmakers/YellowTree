<?php
$username = $_POST['username'];
$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','root','root');
$sql = $cnnx -> prepare( "INSERT INTO `users` (`username`, `email`, `firstname`, `lastname`, `password`, `type`) VALUES (':username', ':email', ':firstname', ':lastname', ':password', ':type')");
$sql -> bindParam(':username', $username);
$sql -> bindParam(':email', $email);
$sql -> bindParam(':firstname', $firstname);
$sql -> bindParam(':lastname', $lastname);
$sql -> bindParam(':password', $password);
$sql -> bindParam(':type', \'user\' );
$sql -> execute();







?>

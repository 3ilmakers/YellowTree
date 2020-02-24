<?php
require "../dbconnect.php";
session_start();
include '../dbconnect.php';
$firstname =$_POST['firstname'];
$lastname =$_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordcheck = $_POST['passwordcheck'];
/*$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
$sql = $cnnx -> prepare("UPDATE `USERS` SET `email`= :email,`firstname`= :firstname,`lastname`= :lastname ,`password`= :password WHERE username = :username ");
$sql -> execute([':email' => $email , ':firstname' => $firstname , ':lastname' => $lastname, ':password' => $password, ':username' => $_SESSION['username']]);
$cnnx = null;*/
if($password == $passwordcheck){
    $cnnx = new connection();
    $cnnx->update($email,$firstname,$lastname,$password,$passwordcheck);
    $cnnx->kill();
    header('location: ../index.php?dashboard=user');
}else {

    header('location: ../index.php?dashboard=user&update_status=wrong_check');

}
?>

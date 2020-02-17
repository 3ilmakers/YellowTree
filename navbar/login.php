<?php
if(isset($_SESSION['type'])){
    header('location: navbar.html');
}
else{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
    $sql = $cnnx -> prepare("SELECT type FROM `users` WHERE email = :email AND password = :password ");
    $sql -> execute([':email' => $email, ':password' => $password]);
    $type = $sql -> fetchAll();
    foreach($type as $types){
         $_SESSION['type'] = $types;
        }
        if(isset($_SESSION['type'])){
            header('location: navbar.html');
            $cnnx = null;
        }
    }
<?php

session_start();
if(isset($_SESSION['type'])){
    header('location: ../index.php');
}
else{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
    $sql = $cnnx -> prepare("SELECT type , username FROM `USERS` WHERE email = :email AND password = :password ");
    $sql -> execute([':email' => $email, ':password' => md5($password)]);
    $type = $sql -> fetchAll();
    echo "TYPES : " . $types;
    if($types=="") header('location: ../index.php?login_status=wrong');
    foreach($type as $types){
      //if($types['type']=="" && $types['username']=="")   header('location: ../index.php');
         $_SESSION['type'] = $types['type'] ;
         $_SESSION['username'] = $types['username'] ;
    }
        if(isset($_SESSION['type']) && isset($_SESSION['username'])){
            header('location: ../index.php');
            $cnnx = null;
        }
    }

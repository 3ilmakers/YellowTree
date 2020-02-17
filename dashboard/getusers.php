<?php 
session_start();
if($_SESSION['type'] == "admin"){
    $username = $_GET['username'];
    $username = "%".$username."%" ;
    echo $username;
    $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
    $sql = $cnnx -> prepare("SELECT * FROM `users` WHERE username LIKE :username ");
    $sql -> execute([':username' =>  $username]);
    $users = $sql -> fetchAll();
    foreach($users as $user){
      print_r($users);
    }

}
else {
    echo "get lost son of a bitch"; 
}
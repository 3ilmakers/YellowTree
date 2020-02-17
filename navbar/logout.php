<?php 
 session_start();
 if(isset($_SESSION['username']) && isset($_SESSION['type'])){
     session_destroy();
     header('location: navbar.php');
     
    

 }
 else {
    header('location: navbar.php');
 }
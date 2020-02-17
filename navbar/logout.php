<?php 
 session_start();
 if(isset($_SESSION['username']) && isset($_SESSION['type'])){
     $user = $_SESSION['username'];
     session_destroy();
     
     echo "goodbye $user";

 }
 else {
     echo "you are not logged in atm";
 }
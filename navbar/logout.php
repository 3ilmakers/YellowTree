<?php
 session_start();
 if(isset($_SESSION['username']) && isset($_SESSION['type'])){
     session_destroy();
     header('location: ../index.php');



 }
 else {
    header('location: ../index.php');
 }

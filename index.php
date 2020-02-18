<?php

$dashboard = $_GET['dashboard'];

  require_once("./navbar/navbar.php");

  if( $dashboard == "admin")    require_once("./dashboard/admin.php");
  if( $dashboard == "user")    require_once("./dashboard/user.php");



 ?>

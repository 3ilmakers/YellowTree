<?php
  session_start();
ini_set('display_errors', 'On');
require_once("./header.php");
require_once("./dbconnect.php");

  require_once("./navbar/navbar.php");

  ?>

<?php
if(isset($_GET['dashboard']))
{
  $dashboard = $_GET['dashboard'];
  if( $dashboard == "admin") {

      if(isset($_SESSION['type'] ))
      {
          if ($_SESSION['type'] != "admin"){
            include_once("./suggest/menu.php");
          }
          else {
            require_once("./dashboard/admin.php");
          }
      } else {
          include_once("./suggest/menu.php");
      }

  }
  if( $dashboard == "user")    require_once("./dashboard/user.php");
}
else {
  include_once("./suggest/menu.php");
}


/* ERROR SECTION*/
if(isset($_GET['login_status'])){
    if($_GET['login_status']=="wrong") {
      echo "<script> alert(\"wrong login\");</script>";
    }
}
if(isset($_GET['update_status'])){
    if($_GET['update_status']=="wrong_check") {
      echo "<script>alert('wrong password due to typing')</script>";
    }
}

 ?>

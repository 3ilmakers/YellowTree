<?php
  session_start();
ini_set('display_errors', 'On');

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





 ?>

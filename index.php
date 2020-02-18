<?php



  require_once("./navbar/navbar.php");
?>

<?php
if(isset($_GET['dashboard']))
{
  $dashboard = $_GET['dashboard'];
  if( $dashboard == "admin")    require_once("./dashboard/admin.php");
  if( $dashboard == "user")    require_once("./dashboard/user.php");
}
else {
  include_once("./suggest/menu.php");
}




 ?>

<?php



  require_once("./navbar/navbar.php");

  //echo "<div style='height:40px; width:100%; display:block; position:absolute; top:0px;'></div>";
if(isset($_GET['dashboard']))
{
  $dashboard = $_GET['dashboard'];
  if( $dashboard == "admin")    require_once("./dashboard/admin.php");
  if( $dashboard == "user")    require_once("./dashboard/user.php");
}




 ?>

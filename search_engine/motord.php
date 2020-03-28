<h1>Motor deamon is running</h1>
<?php
error_reporting(E_ALL);
  require_once './dbmotor.php';
  $cnnx = new motor();
  $cnnx->write_word();



  $cnnx->kill();
 ?>

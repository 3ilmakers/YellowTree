<h1>Motor search</h1>
<?php

error_reporting(E_ALL);
	require_once './dbmotor.php';
	$cnnx = new motor();

	var_dump($cnnx->search_word("django",3,0));
	$cnnx->search_word("djiango");
	$cnnx->search_word("iijango");
	$cnnx->search_word("iidjango");
	 $cnnx->kill();
?>

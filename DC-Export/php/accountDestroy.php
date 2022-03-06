<?php 
	session_start();
	session_destroy();

	header('Location: ../fr/index.php');
?>
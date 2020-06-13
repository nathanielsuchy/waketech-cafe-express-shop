<?php
	require_once('./include/config.php');

	

	if (($key = array_search($_GET['id'], $_SESSION["cart"])) !== false) {
		unset($_SESSION["cart"][$key]); 
	}

	header('Location: '.$baseUrl.'/cart.php');
	die();
?>
<?php
	require_once('./include/config.php');

	$stmt = $conn->prepare("SELECT * FROM Products WHERE id=:id LIMIT 1");
	$stmt->bindParam(':id', $_GET["id"]);
    $stmt->execute();

	// If the user has not logged in the cart array won't exist and this can cause a bug.
	// This hotfix sets the cart to a blank array to work around this issue!
	if ($_SESSION["cart"] == null)
	{
		$_SESSION["cart"] = array();
	}

	if (count($stmt->fetchAll()) > 0)
	{
		array_push($_SESSION["cart"], $_GET["id"]);
	}

	header('Location: '.$baseUrl.'/cart.php');
	exit;
?>
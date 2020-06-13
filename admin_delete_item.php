<?php
	require_once('./include/config.php');
?>

<?php
 if (!(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1))
 {
 	 die("<h1>Request denied. User is not an administrator.</h1>");
 }

    $stmt = $conn->prepare("DELETE FROM Products WHERE id=:id");
	$stmt->bindParam(':id', $_GET["id"]);
    $stmt->execute();

    header('Location: '.$baseUrl.'/products.php?id=1');
	die();
?>

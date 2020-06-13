<?php
	$pageTitle = "View Product";

	require_once('./include/config.php');
	require_once('./header.php');

	$stmt = $conn->prepare("SELECT * FROM Products WHERE id=:id LIMIT 1");
	$stmt->bindParam(':id', $_GET["id"]);
    $stmt->execute();

	$result = $stmt->fetchAll()[0];

?>

<div class="jumbotron">
	<h1 class="display-4"><?php echo $pageTitle; ?></h1>
	<div class="card">
	  <h5 class="card-header"><?php echo $result["title"]; ?></h5>
	  <div class="card-body">
		<img class="card-img-top" src="<?php echo htmlspecialchars($result["image"]); ?>" style="max-width:300px; max-height:300px;">
		<h5 class="card-title"><?php echo htmlspecialchars($result["details"]); ?></h5>
		<a href="<?php echo $baseUrl; ?>addtocart.php?id=<?php echo htmlspecialchars($result["id"]); ?>" class="btn btn-primary">Add To Cart (<?php echo htmlspecialchars("$".number_format($result["price"], 2)); ?>)</a>
	  </div>
	</div>
</div>

<?php
	require_once('./footer.php');
?>
<?php
	switch ($_GET["id"]) {
		case 1:
			$pageTitle = "Coffee Beans";
			break;
		case 2:
			$pageTitle = "Expresso";
			break;
		case 3:
			$pageTitle = "Creamers";
			break;
		default:
			$pageTitle = "Products";
			break;
	}

	

	require_once('./include/config.php');
	require_once('./header.php');
	
	$stmt = $conn->prepare("SELECT * FROM Products WHERE category=:id");
	$stmt->bindParam(':id', $_GET["id"]);
    $stmt->execute();

	$products = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		array_push($products, $row);
	}

?>

<div class="jumbotron">
	<h1 class="display-4"><?php echo $pageTitle; ?> For Sale</h1>

	<?php
	$numOfCols = 4;
	$rowCount = 0;
	$bootstrapColWidth = 12 / $numOfCols;
	foreach ($products as &$product){
	
	$id = htmlspecialchars($product["id"]);
	$title = htmlspecialchars($product["title"]);
	$details = htmlspecialchars($product["details"]);
	$price = htmlspecialchars("$".number_format($product["price"], 2));

	if($rowCount % $numOfCols == 0) { ?> <div class="row"> <?php } 
		$rowCount++; ?>  
			<div class="col-md-<?php echo $bootstrapColWidth; ?>">
			<div class="card">
				<img class="card-img-top" src="<?php echo htmlspecialchars($product["image"]); ?>" alt="Card image cap">
				<div class="card-body">
					<h5 class="card-title"><?php echo $title; ?></h5>
					<p class="card-text"><?php echo htmlspecialchars($product["details"]); ?></p>
					<a href="product.php?id=<?php echo htmlspecialchars($product["id"]); ?>" class="btn btn-primary">View Details</a>
					<a href="addtocart.php?id=<?php echo htmlspecialchars($product["id"]); ?>" class="btn btn-secondary">Add To Cart</a>
				</div>
			</div>
				<div class="thumbnail">
					<img >
				</div>
			</div>
	<?php
		if($rowCount % $numOfCols == 0) { ?> </div> <?php } } 
	?>
</div>

<?php
	require_once('./footer.php');
?>
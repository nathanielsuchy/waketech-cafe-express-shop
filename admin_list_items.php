<?php
	$pageTitle = "Admin - List Items";
	require_once('./include/config.php');
	require_once('./header.php');
	
	$stmt = $conn->prepare("SELECT * FROM Products");
    $stmt->execute();

	$products = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		array_push($products, $row);
	}
?>

<?php
 if (!(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1))
 {
 	 die("<h1>Request denied. User is not an administrator.</h1>");
 }
?>

<div class="jumbotron">
	<h1 class="display-4"><?php echo $pageTitle; ?></h1>
	
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Title</th>
				<th scope="col">Details</th>
				<th scope="col">Price</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			  foreach($products as &$product)
			  {
				$id = htmlspecialchars($product["id"]);
				$title = htmlspecialchars($product["title"]);
				$details = htmlspecialchars($product["details"]);
				$price = htmlspecialchars("$".number_format($product["price"], 2));
;
				echo "
					<tr>
						<td>$title</td>
						<td>$details</td>
						<td>$price</td>
						<td>
							<a href=\"admin_edit_item.php?id=$id\" class=\"btn btn-primary\">Edit Item</a>
							<a href=\"admin_delete_item.php?id=$id\" class=\"btn btn-secondary\">Delete Item</a>
						</td>
					</tr>
				";
			  }
			?>
		</tbody>
	</table>
</div>

<?php
	require_once('./footer.php');
?>
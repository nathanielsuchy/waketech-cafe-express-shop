<?php
	$pageTitle = "Shopping Cart";
	require_once('./include/config.php');
	require_once('./header.php');
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
			  $subtotal = 0;
			  foreach($_SESSION["cart"] as &$item)
			  {

				$stmt = $conn->prepare("SELECT * FROM Products WHERE id=:id LIMIT 1");
				$stmt->bindParam(':id', $item);
				$stmt->execute();
				$product = $stmt->fetchAll()[0];

				$id = htmlspecialchars($product["id"]);
				$title = htmlspecialchars($product["title"]);
				$details = htmlspecialchars($product["details"]);
				$price = htmlspecialchars("$".number_format($product["price"], 2));
				$subtotal += $product["price"];
				echo "
					<tr>
						<td>$title</td>
						<td>$details</td>
						<td>$price</td>
						<td>
							<a href=\"removefromcart.php?id=$id\" class=\"btn btn-danger\">Remove From Cart</a>
						</td>
					</tr>
				";
			  }
			?>
		</tbody>
	</table>
	<?php
		$tax = ($subtotal * 7.25)*0.01;
		$total = $subtotal + $tax;
	?>
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Detail</th>
				<th scope="col">Amount</th>
			</tr>
		</thead>
		<tbody>
			  <tr>
			  	<td>Sub Total</td>
				<td><?php echo htmlspecialchars("$".number_format($subtotal, 2)); ?></td>
			  </tr>
			  <tr>
			  	<td>Tax (7.25%)</td>
				<td><?php echo htmlspecialchars("$".number_format($tax, 2)); ?></td>
			  </tr>
			  <tr>
			  	<td>Total</td>
				<td><?php echo htmlspecialchars("$".number_format($total, 2)); ?></td>
			  </tr>
		</tbody>
	</table>

	<a href="checkout.php"" class="btn btn-primary">Proceed To Checkout</a>
</div>

<?php
	require_once('./footer.php');
?>
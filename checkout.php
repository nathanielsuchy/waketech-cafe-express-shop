<?php
	$pageTitle = "Checkout";
	require_once('./include/config.php');
	require_once('./header.php');
	$_SESSION["cart"] = array();
?>

<div class="jumbotron">
	<h1 class="display-4">Thank you for your purchase!</h1>
	<p class="lead">A PayPal invoice has been sent to the email on file.
	We will only ship to the address provided to us by PayPal.</p>
</div>

<?php
	require_once('./footer.php');
?>
<?php
	$pageTitle = "Home";
	require_once('./include/config.php');
	require_once('./header.php');
?>

<div class="jumbotron">
	<h1 class="display-4">Welcome to the Cafe Express Shop</h1>
	<p class="lead">Here you can purchase anything your cafe could possibly need!</p>
	<img src="<?php echo $baseUrl; ?>/images/coffee-2714970_1920.jpg" class="img-fluid" />
</div>

<?php
	require_once('./footer.php');
?>
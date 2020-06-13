<?php
	$pageTitle = "Home";
	require_once('./include/config.php');
	require_once('./header.php');
?>

<div class="jumbotron">
	<h1 class="display-4">Debug Information</h1>
	<?php
	  print_r($_SESSION);
	  ?>
</div>

<?php
	require_once('./footer.php');
?>
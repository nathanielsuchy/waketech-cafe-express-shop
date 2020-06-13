<?php
	$pageTitle = "Admin Area";
	require_once('./include/config.php');
	require_once('./header.php');
?>

<?php
 if (!(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1))
 {
 	 die("<h1>Request denied. User is not an administrator.</h1>");
 }
?>

<div class="jumbotron">
	<h1 class="display-4">Admin Tools</h1>
	<ul class="list-group">
		<li class="list-group-item"><a href="<?php echo $baseUrl; ?>/admin_list_items.php">List Items</a></li>
		<li class="list-group-item"><a href="<?php echo $baseUrl; ?>/admin_add_item.php">Add Item</a></li>
		<li class="list-group-item"><a href="<?php echo $baseUrl; ?>/admin_upload_file.php">Upload File</a></li>
	</ul>
</div>

<?php
	require_once('./footer.php');
?>
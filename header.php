<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
			<?php
				if (isset($pageTitle))
				{
				echo $pageTitle; 
				}
			?>
			 - Cafe Express Shop
		</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
	<nav class="navbar navbar-dark navgreen">
		  <a class="navbar-brand" href="<?php echo $baseUrl; ?>/index.php">Cafe Express Shop</a>
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo $baseUrl; ?>/index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $baseUrl; ?>/products.php?id=1">Coffee Beans</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="<?php echo $baseUrl; ?>/products.php?id=2">Expresso</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="<?php echo $baseUrl; ?>/products.php?id=3">Creamers</a>
          </li>
		  <?php
			if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1)
			{
				echo '
					<li class="nav-item">
					 <a class="nav-link" href="admin.php">Admin</a>
					</li>
				';
			}
		  ?>
        </ul>
		<ul class="nav ml-auto">
		  <?php
			if (isset($_SESSION["cart"]) && sizeof($_SESSION["cart"]) > 0)
			{
				echo '
					<li class="nav-item">
						<a class="nav-link" href="cart.php">My Cart</a>
					</li>
				';
			}

		    if (isset($_SESSION["email"]) && $_SESSION["email"] != null)
			{
				echo '
					<li class="nav-item">
					 <a class="nav-link" href="logout.php">Logout</a>
					</li>
				';
			}
			else
			{
				echo '
						<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="register.php">Register</a>
				  </li>
				';
			}
			?>
        </ul>
	</nav>
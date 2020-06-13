<?php
	$pageTitle = "Login";
	require_once('./include/config.php');
	require_once('./header.php');
?>

<?php
 if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {

	$stmt = $conn->prepare("SELECT * FROM Users WHERE email=:email LIMIT 1");
	$stmt->bindParam(':email', $_POST["email"]);
    $stmt->execute();

	$result = $stmt->fetchAll()[0];

	$email = $result["email"];
	$password = $result["password"];
	$is_admin = 0;
	if ($result["is_admin"] == 1)
	{
		$is_admin = 1;
	}
	
	$valid = password_verify ($_POST["password"], $password);

	if ($valid)
	{
		$_SESSION["email"] = $email;
		$_SESSION["admin"] = $is_admin;
		$_SESSION['ipaddress'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['lastaccess'] = time();
		$_SESSION["cart"] = array();
		header('Location: '.$baseUrl.'/');
		die();
	}
	else
	{
		die("<h1>Invalid email or password!</h1>");
	}
 }
?>

<div class="jumbotron">
	<h1 class="display-4">Login</h1>
	<form method="post">
		<div class="form-group">
			<strong>Email:</strong><br>
			<input type="email" name="email" class="form-control" />
		</div>
		<div class="form-group">
			<strong>Password:</strong><br>
			<input type="password" name="password" class="form-control" />
		</div>
		<input type="submit" class="btn btn-primary" value="Login" />
	</form>
</div>

<?php
	require_once('./footer.php');
?>
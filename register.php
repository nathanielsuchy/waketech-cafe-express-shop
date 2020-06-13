<?php
	$pageTitle = "Register";
	require_once('./include/config.php');
	require_once('./header.php');
?>

<?php
 if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {

	$alreadyRegistered = false;
	$stmt = $conn->prepare("SELECT id FROM Users WHERE email=:email");
	$stmt->bindParam(':email', $_POST["email"]);
    $stmt->execute();

	$count = (int) count($stmt->fetchAll());

	if ($count > 0)
	{
		$alreadyRegistered = true;
	}
	
	if ($alreadyRegistered == true)
	{
		die("<h1>Account Email already registered!</h1>");
	}

	$stmt = $conn->prepare("INSERT INTO Users (email, password)
    VALUES (:email, :password)");

    $stmt->bindParam(':email', $_POST["email"]);
	$stmt->bindParam(':password', password_hash($_POST["password"], PASSWORD_BCRYPT, ['cost' => 12]));

    $stmt->execute();

	header('Location: '.$baseUrl.'/');
	die();
 }
?>

<div class="jumbotron">
	<h1 class="display-4">Register Account</h1>
	<form method="post">
		<div class="form-group">
			<strong>Email:</strong><br>
			<input type="email" name="email" class="form-control" />
		</div>
		<div class="form-group">
			<strong>Password:</strong><br>
			<input type="password" name="password" class="form-control" />
		</div>
		<input type="submit" class="btn btn-primary" value="Process Registration" />
	</form>
</div>

<?php
	require_once('./footer.php');
?>
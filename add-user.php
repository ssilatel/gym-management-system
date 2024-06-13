<?php
require_once "lib/common.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

$errors = array();
if ($_POST)
{
	$username = $_POST["username"];
	if (!$username)
	{
		$errors[] = "Please enter a username";
	}
	$password = $_POST["password"];
	if (!$password)
	{
		$errors[] = "Please enter a password";
	}

	if (!$errors)
	{
		$pdo = getPDO();
		addUser($pdo, $username, $password);
		redirectAndExit("users.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<?php require "templates/navbar.php" ?>

		<h1>Register</h1>

		<?php if ($errors): ?>
			<div>
				<ul>
					<?php foreach ($errors as $error): ?>
							<li><?php echo $error ?></li>
					<?php endforeach ?>
				</ul>
			</div>
		<?php endif ?>

		<form method="post">
			<div>
				<label for="username">Username:</label>
				<input type="text" id="username" name="username">
			</div>
			<div>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password">
			</div>
			<button type="submit">Add User</button>
		</form>
	</body>
</html>

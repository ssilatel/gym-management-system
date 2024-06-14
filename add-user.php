<?php
require_once "lib/common.php";
require_once "lib/users.php";

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
		$result = addUser($pdo, $username, $password);
		if (!$result)
		{
			$errors[] = "That username is already in use";
		}
		else
		{
			redirectAndExit("users.php");
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add User - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<?php require "templates/navbar.php" ?>

		<h1>Add User</h1>

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
			<a href="users.php">Cancel</a>
		</form>
	</body>
</html>

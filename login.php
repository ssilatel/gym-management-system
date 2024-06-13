<?php
require_once "lib/common.php";

session_start();

if (isLoggedIn())
{
	redirectAndExit("index.php");
}

$username = "";
if ($_POST)
{
	$pdo = getPDO();
	$username = $_POST["username"];
	$ok = tryLogin($pdo, $username, $_POST["password"]);
	if ($ok)
	{
		login($username);
		redirectAndExit("index.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<?php require "templates/navbar.php" ?>

		<h1>Login</h1>

		<?php if ($username): ?>
			<div>
				The username or password is incorrect, try again
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
			<button type="submit">Submit</button>
		</form>
	</body>
</html>

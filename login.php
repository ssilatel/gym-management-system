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
		<div class="container">
			<?php require "templates/navbar.php" ?>

			<h1 class="mt-4 mb-4 display-6">Login</h1>

			<?php if ($username): ?>
				<div>
					The username or password is incorrect, try again
				</div>
			<?php endif ?>

			<form method="post">
				<div class="mb-3">
					<label class="form-label" for="username">Username:</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="mb-3">
					<label class="form-label" for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password">
				</div class="mb-3">
				<button class="btn btn-primary" type="submit">Login</button>
			</form>
		</div>
	</body>
</html>

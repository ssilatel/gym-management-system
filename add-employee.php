<?php
require_once "lib/common.php";
require_once "lib/employees.php";

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
		$result = addEmployee($pdo, $username, $password);
		if (!$result)
		{
			$errors[] = "That username is already in use";
		}
		else
		{
			redirectAndExit("employees.php");
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add Employee - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<div class="container">
			<?php require "templates/navbar.php" ?>

			<h1 class="mt-4 mb-4 display-6">Add Employee</h1>

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
				<div class="mb-3">
					<label class="form-label" for="username">Username:</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="mb-3">
					<label class="form-label" for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<button class="btn btn-primary" type="submit">Add Employee</button>
				<a class="btn btn-warning" href="employees.php">Cancel</a>
			</form>
		</div>
	</body>
</html>

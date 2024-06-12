<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<h1>Login</h1>

		<?php require "templates/navbar.php" ?>

		<form action="post">
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

<?php
require_once "lib/common.php";
require_once "lib/members.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

$errors = array();
if ($_POST)
{
	$first_name = $_POST["first_name"];
	if (!$first_name)
	{
		$errors[] = "Please enter a first name";
	}
	$last_name = $_POST["last_name"];
	if (!$last_name)
	{
		$errors[] = "Please enter a last name";
	}
	$birthday = $_POST["birthday"];
	if (!$last_name)
	{
		$errors[] = "Please enter a birthday";
	}

	if (!$errors)
	{
		$pdo = getPDO();
		$result = addMember($pdo, $first_name, $last_name, $birthday);
		if (!$result)
		{
			$errors[] = "There was an error adding the member";
		}
		else
		{
			redirectAndExit("members.php");
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add Member - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<?php require "templates/navbar.php" ?>

		<h1>Add Member</h1>

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
				<label for="first_name">First Name:</label>
				<input type="text" id="first_name" name="first_name">
			</div>
			<div>
				<label for="last_name">Last Name:</label>
				<input type="text" id="last_name" name="last_name">
			</div>
			<div>
				<label for="birthday">Birthday:</label>
				<input type="date" id="birthday" name="birthday">
			</div>
			<button type="submit">Add Member</button>
			<a href="members.php">Cancel</a>
		</form>
	</body>
</html>

<?php
require_once "lib/common.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

if ($_POST)
{
	$deleteResponse = $_POST["delete-user"];
	if ($deleteResponse)
	{
		$keys = array_keys($deleteResponse);
		$deleteUserID = $keys[0];
		if ($deleteUserID)
		{
			deleteUser(getPDO(), $deleteUserID);
			redirectAndExit("users.php");
		}
	}
}

$pdo = getPDO();
$users = getAllUsers($pdo);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add User - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<?php require "templates/navbar.php" ?>

		<a href="add-user.php">Add User</a>

		<form method="post">
			<table id="user-list">
				<thead>
					<tr>
						<th></th>
						<th>Username</th>
						<th>Created</th>
						<th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo htmlEscape($user["id"]) ?></td>
							<td><?php echo htmlEscape($user["username"]) ?></td>
							<td><?php echo convertSqlDate($user["created_at"]) ?></td>
							<td><input type="submit" name="delete-user[<?php echo $user['id'] ?>]" value="Delete"></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</form>
	</body>
</html>

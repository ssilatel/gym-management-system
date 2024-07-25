<?php
require_once "lib/common.php";

session_start();

$root = realpath(__DIR__);
$database = $root . "/data/data.sqlite";
$dsn = "sqlite:" . $database;
$pdo = getPDO();

$error = "";

if (is_readable($database) && filesize($database) > 0)
{
	$error = "Please delete the existing database manually before re-installing";
}

if (!$error)
{
	$createdOk = @touch($database);
	if (!$createdOk)
	{
		$error = sprintf("Could not create the database, please allow the server to create new files in '%s'", dirname($database));
	}
}

if (!$error)
{
	$sql = file_get_contents($root . "/data/init.sql");

	if ($sql === false)
	{
		$error = "Cannot find SQL file";
	}
}

if (!$error)
{
	$result = $pdo->exec($sql);
	if ($result === false)
	{
		$error = "Could not run SQL: " . print_r($pdo->errorInfo(), true);
	}
}

$count = null;
if (!$error)
{
	$sql = "SELECT COUNT(*) AS c FROM employee";
	$stmt = $pdo->query($sql);
	if ($stmt)
	{
		$count = $stmt->fetchColumn();
	}
}

$sql = "INSERT INTO employee(username, password, created_at, is_admin) VALUES(:username, :password, :created_at, :is_admin)";
$stmt = $pdo->prepare($sql);
if ($stmt === false)
{
	$error = "Could not create admin user";
}
$hash = password_hash("admin", PASSWORD_DEFAULT);
if ($hash === false)
{
	$error = "Admin password hashing failed";
}
if (!$error)
{
	$result = $stmt->execute(array(
		"username" => "admin",
		"password" => $hash,
		"created_at" => getSqlDateForNow(),
		"is_admin" => 1,
	));
}
if ($result === false)
{
	$error = "Could not insert admin user";
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Installer - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<div class="container">
			<?php require "templates/navbar.php" ?>

			<?php if ($error): ?>
				<div>
					<?php echo $error ?>
				</div>
			<?php else: ?>
				<div>
					The database and demo data was created successfully.
					<?php if ($count): ?>
						<?php echo $count ?> new users were created.
					<?php endif ?>
				</div>
			<?php endif ?>
		</div>
	</body>
</html>

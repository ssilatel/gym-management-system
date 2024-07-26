<?php
require_once "lib/common.php";
require_once "lib/products.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

$errors = array();
if ($_POST)
{
	$name = $_POST["name"];
	if (!$name)
	{
		$errors[] = "Please enter a product name";
	}
	$price = $_POST["price"];
	if (!$price)
	{
		$errors[] = "Please enter a product price";
	}

	if (!$errors)
	{
		$pdo = getPDO();
		$result = addProduct($pdo, $name, $price);
		if (!$result)
		{
			$errors[] = "There was an error adding the product";
		}
		else
		{
			redirectAndExit("products.php");
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add Product - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<div class="container">
			<?php require "templates/navbar.php" ?>

			<h1 class="mt-4 mb-4 display-6">Add Member</h1>

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
					<label class="form-label" for="name">Name:</label>
					<input type="text" class="form-control" id="name" name="name">
				</div>
				<div class="mb-3">
					<label class="form-label" for="price">Price:</label>
					<input type="number" class="form-control" id="price" name="price">
				</div>
				<button class="btn btn-primary" type="submit">Add Product</button>
				<a class="btn btn-warning" href="products.php">Cancel</a>
			</form>
		</div>
	</body>
</html>

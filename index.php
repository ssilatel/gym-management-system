<?php
require_once "lib/common.php";

session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<div class="container">
			<?php require "templates/navbar.php" ?>

			<?php if (!isLoggedIn()): ?>
				<div class="container text-center">
					<div class="row justify-content-md-center">
						<div class="col-md-auto mt-5">
							<div class="card" style="width: 18rem;">
								<div class="card-body">
									<h5 class="card-title">Login</h5>
									<p class="card-text">Login to the system</p>
									<a href="login.php" class="btn btn-primary">Login</a>
								</div>
							</div>
						</div>
						<div class="col-md-auto mt-5">
							<div class="card" style="width: 18rem;">
								<div class="card-body">
									<h5 class="card-title">Install</h5>
									<p class="card-text">Reset and install the database</p>
									<a href="install.php" class="btn btn-primary">Install</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php elseif (isLoggedIn()): ?>
			<div class="container text-center">
				<div class="row justify-content-md-center">
					<div class="col-md-auto mt-5">
						<div class="card" style="width: 18rem;">
							<div class="card-body">
								<h5 class="card-title">Employees</h5>
								<p class="card-text">List all employees</p>
								<a href="employees.php" class="btn btn-primary">Employees</a>
							</div>
						</div>
					</div>
					<div class="col-md-auto mt-5">
						<div class="card" style="width: 18rem;">
							<div class="card-body">
								<h5 class="card-title">Members</h5>
								<p class="card-text">View the registered members</p>
								<a href="members.php" class="btn btn-primary">Members</a>
							</div>
						</div>
					</div>
					<div class="col-md-auto mt-5">
						<div class="card" style="width: 18rem;">
							<div class="card-body">
								<h5 class="card-title">Products</h5>
								<p class="card-text">See all products</p>
								<a href="products.php" class="btn btn-primary">Products</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif ?>
		</div>
	</body>
</html>

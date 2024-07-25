<?php
require_once "lib/common.php";
require_once "lib/employees.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

if ($_POST)
{
	$deleteResponse = $_POST["delete-employee"];
	if ($deleteResponse)
	{
		$keys = array_keys($deleteResponse);
		$deleteEmployeeID = $keys[0];
		if ($deleteEmployeeID)
		{
			deleteEmployee(getPDO(), $deleteEmployeeID);
			redirectAndExit("employees.php");
		}
	}
}

$pdo = getPDO();
$employees = getAllEmployees($pdo);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Employees - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<div class="container">
			<?php require "templates/navbar.php" ?>

			<div class="container mt-5">
				<a class="btn btn-primary" href="add-employee.php">Add Employee</a>
			</div>

			<div class="container mt-5">
				<form method="post">
					<div class="table-responsive">
						<table class="table table-hover table-bordered align-middle" id="employee-list">
							<thead>
								<tr>
									<th>Username</th>
									<th>Created</th>
									<th>
								</tr>
							</thead>
							<tbody class="table-group-divider">
								<?php foreach ($employees as $employee): ?>
									<tr>
										<td><?php echo htmlEscape($employee["username"]) ?></td>
										<td><?php echo convertSqlDatetime($employee["created_at"]) ?></td>
										<td><input class="btn btn-danger" type="submit" name="delete-employee[<?php echo $employee['id'] ?>]" value="Delete"></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>

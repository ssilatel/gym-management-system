<?php
require_once "lib/common.php";
require_once "lib/purchases.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

$pdo = getPDO();
$purchases = getAllPurchases($pdo);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Purchase History - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<div class="container">
			<?php require "templates/navbar.php" ?>

			<h1 class="mt-4 mb-4 display-6">Purchase History</h1>

			<div class="container mt-5">
				<div class="table-responsive">
					<table class="table table-hover table-bordered align-middle" id="purchase-list">
						<thead>
							<tr>
								<th>Product</th>
								<th>Member</th>
								<th>Employee</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody class="table-group-divider">
							<?php foreach ($purchases as $purchase): ?>
								<tr>
									<td><?php echo htmlEscape(getProductName($pdo, $purchase["product_id"])) ?></td>
									<td><?php echo htmlEscape(getMemberName($pdo, $purchase["member_id"])) ?></td>
									<td><?php echo htmlEscape(getEmployeeUsername($pdo, $purchase["employee_id"])) ?></td>
									<td><?php echo convertSqlDatetime($purchase["purchase_date"]) ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>

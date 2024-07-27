<?php
require_once "lib/common.php";
require_once "lib/purchases.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

$pdo = getPDO();
$count = purchaseCount($pdo);
$page = isset($_GET["page"]) && is_numeric($_GET["page"]) ? $_GET["page"] : 1;
$resultsPerPage = 10;
$purchases = getPurchases($pdo, $page, $resultsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Purchase History - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<div class="container text-center">
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
					<div class="container d-flex">
						<nav class="col" aria-label="Page navigation">
							<ul class="pagination mx-auto justify-content-center">
								<?php if ($page - 1 <= 0): ?>
									<li class="page-item"><a class="page-link disabled">&laquo</a></li>
								<?php else: ?>
									<li class="page-item"><a class="page-link" href="purchase-history.php?page=<?php echo ($page - 1) ?>">&laquo</a></li>
								<?php endif ?>
								<?php if ($page - 2 > 0): ?>
									<li class="page-item"><a class="page-link" href="purchase-history.php?page=<?php echo ($page - 2) ?>"><?php echo ($page - 2); ?></a></li>
								<?php endif ?>
								<?php if ($page - 1 > 0): ?>
									<li class="page-item"><a class="page-link" href="purchase-history.php?page=<?php echo ($page - 1) ?>"><?php echo ($page - 1); ?></a></li>
								<?php endif ?>
								<li class="page-item"><a class="page-link active"><?php echo $page ?></a></li>
								<?php if ( $resultsPerPage * $page < $count): ?>
									<li class="page-item"><a class="page-link" href="purchase-history.php?page=<?php echo ($page + 1) ?>"><?php echo ($page + 1); ?></a></li>
								<?php endif ?>
								<?php if ($resultsPerPage * $page + $page + 1 < $count): ?>
									<li class="page-item"><a class="page-link" href="purchase-history.php?page=<?php echo ($page + 2) ?>"><?php echo ($page + 2); ?></a></li>
								<?php endif ?>
								<?php if ($page * $resultsPerPage >= $count): ?>
									<li class="page-item"><a class="page-link disabled">&raquo</a></li>
								<?php else: ?>
									<li class="page-item"><a class="page-link" href="purchase-history.php?page=<?php echo ($page + 1) ?>">&raquo</a></li>
								<?php endif ?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
require_once "lib/common.php";
require_once "lib/products.php";
require_once "lib/members.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

if ($_POST)
{
	if (isset($_POST["delete-product"]))
	{
		$deleteResponse = $_POST["delete-product"];
		$keys = array_keys($deleteResponse);
		$deleteProductID = $keys[0];
		if ($deleteProductID)
		{
			deleteProduct(getPDO(), $deleteProductID);
			redirectAndExit("products.php");
		}
	}
	else if (isset($_POST["product-id"]) && isset($_POST["member-id"]))
	{
		$purchaseProductID = $_POST["product-id"];
		$memberID = $_POST["member-id"];
		if ($purchaseProductID)
		{
			purchaseProduct(getPDO(), $purchaseProductID, $memberID, getUserID());
			redirectAndExit("products.php");
		}
	}
}

$pdo = getPDO();
$products = getAllProducts($pdo);
$members = getAllMembers($pdo);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Products - Gym Management System</title>
		<?php require "templates/header.php" ?>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	</head>
	<body>
		<div class="container text-center">
			<?php require "templates/navbar.php" ?>

			<div class="container mt-5">
				<a class="btn btn-primary" href="add-product.php">Add Product</a>
				<a class="btn btn-outline-primary" href="purchase-history.php">Purchase History</a>
			</div>

			<div class="container mt-5">
				<form method="post">
					<div class="table-responsive">
						<table class="table table-hover table-bordered align-middle" id="product-list">
							<thead>
								<tr>
									<th>Name</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody class="table-group-divider">
								<?php foreach ($products as $product): ?>
									<tr>
										<td><?php echo htmlEscape($product["name"]) ?></td>
										<td><?php echo htmlEscape($product["price"]) ?>€</td>
										<td>
											<select class="form-select form-select-sm mb-3" name="member-id">
												<?php foreach ($members as $member): ?>
													<option value="<?php echo htmlEscape($member['id']) ?>">
														<?php echo htmlEscape($member["first_name"]); echo " "; echo htmlEscape($member["last_name"]) ?>
													</option>
												<?php endforeach ?>
											</select>
											<!--
											<input class="btn btn-success purchase-button" type="submit" id="<?php echo $product['id'] ?>"name="purchase-product[<?php echo $product['id'] ?>]" value="Purchase">
											-->
											<button class="btn btn-success purchase-button" id="<?php echo $product['id'] ?>">Purchase</button>
										</td>
										<td><input class="btn btn-danger" type="submit" name="delete-product[<?php echo $product['id'] ?>]" value="Delete"</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>

		<script>
			$(document).ready(function() {
				$(".purchase-button").on("click", function(e) {
					e.preventDefault();
					var row = $(this).closest("tr");

					var productID = $(this).attr("id");
					var memberID = row.find("select[name='member-id']").val();

					$.post(window.location.href, {
						"product-id": productID,
						"member-id": memberID
					})
					.done(function(response) {
						window.location.reload();
					})
					.fail(function(jqXHR, textStatus, errorThrown) {
						console.error("Error during purchase request:", textStatus, errorThrown);
					});
				});
			});
		</script>
	</body>
</html>


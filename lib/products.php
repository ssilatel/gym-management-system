<?php
function addProduct(PDO $pdo, $name, $price)
{
	$sql = "INSERT INTO product(name, price, created_at) VALUES(:name, :price, :created_at)";
	$stmt = $pdo->prepare($sql);

	$result = $stmt->execute(array(
		"name" => $name,
		"price" => $price,
		"created_at" => getSqlDateForNow(),
	));

	return $result !== false;
}

function getAllProducts(PDO $pdo)
{
	$stmt = $pdo->query("SELECT id, name, price, created_at FROM product");
	if ($stmt === false)
	{
		throw new Exception("There was a problem preparing the query");
	}

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteProduct(PDO $pdo, $productID)
{
	$sql = "DELETE FROM product WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	if ($stmt === false)
	{
		throw new Exception("There was a problem preparing the query");
	}
	$stmt->execute(array("id" => $productID, ));
}

function purchaseProduct(PDO $pdo, $productID, $memberID, $employeeID)
{
	$sql = "INSERT INTO purchase(product_id, member_id, employee_id, purchase_date) VALUES(:product_id, :member_id, :employee_id, :purchase_date)";
	$stmt = $pdo->prepare($sql);

	$result = $stmt->execute(array(
		"product_id" => $productID,
		"member_id" => $memberID,
		"employee_id" => $employeeID,
		"purchase_date" => getSqlDateForNow(),
	));

	return $result !== false;
}
?>

<?php
function getAllPurchases(PDO $pdo)
{
	$stmt = $pdo->query("SELECT product_id, member_id, employee_id, purchase_date FROM purchase");
	if ($stmt === false)
	{
		throw new Exception("There was a problem preparing the query");
	}

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductName(PDO $pdo, $id)
{
	$sql = "SELECT name FROM product WHERE id = :id";
	$stmt = $pdo->prepare($sql);

	$stmt->execute(array("id" => $id, ));
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $result[0]["name"];
}

function getMemberName(PDO $pdo, $id)
{
	$sql = "SELECT first_name, last_name FROM member WHERE id = :id";
	$stmt = $pdo->prepare($sql);

	$stmt->execute(array("id" => $id, ));
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $result[0]["first_name"] . " " . $result[0]["last_name"];
}

function getEmployeeUsername(PDO $pdo, $id)
{
	$sql = "SELECT username FROM employee WHERE id = :id";
	$stmt = $pdo->prepare($sql);

	$stmt->execute(array("id" => $id, ));
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $result[0]["username"];
}
?>

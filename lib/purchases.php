<?php
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

function purchaseCount(PDO $pdo)
{
	$stmt = $pdo->prepare("SELECT COUNT(*) FROM purchase");
	$stmt->execute();

	$count = $stmt->fetchColumn();
	return $count;
}

function getPurchases(PDO $pdo, $page, $resultsPerPage)
{
	$start = ($page - 1) * $resultsPerPage;
	$stmt = $pdo->query("SELECT product_id, member_id, employee_id, purchase_date FROM purchase ORDER BY purchase_date DESC LIMIT $start, $resultsPerPage");
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}
?>

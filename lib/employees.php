<?php
function addEmployee(PDO $pdo, $username, $password)
{
	$error = "";

	$sql = "INSERT INTO employee(username, password, created_at, is_admin) VALUES(:username, :password, :created_at, :is_admin)";
	$stmt = $pdo->prepare($sql);

	$hash = password_hash($password, PASSWORD_DEFAULT);
	if ($hash === false)
	{
		$error = "Password hashing failed";
	}

	if (!$error)
	{
		try {
			$result = $stmt->execute(array(
				"username" => $username,
				"password" => $hash,
				"created_at" => getSqlDateForNow(),
				"is_admin" => 0,
			));
			return $result;
		} catch (PDOException $e) {
			if ($e->getCode() == 23000) {
				// Username already exists
				return false;
			}
		}
	}

	return false;
}

function getAllEmployees(PDO $pdo)
{
	$stmt = $pdo->query("SELECT id, username, created_at FROM employee");
	if ($stmt === false)
	{
		throw new Exception("There was a problem preparing the query");
	}

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteEmployee(PDO $pdo, $employeeID)
{
	$sql = "DELETE FROM employee WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	if ($stmt === false)
	{
		throw new Exception("There was a problem preparing the query");
	}
	$stmt->execute(array("id" => $employeeID, ));
}
?>

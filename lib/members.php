<?php
function addMember(PDO $pdo, $first_name, $last_name, $birthday)
{
	$sql = "INSERT INTO member(first_name, last_name, birthday, created_at) VALUES(:first_name, :last_name, :birthday, :created_at)";
	$stmt = $pdo->prepare($sql);

	$result = $stmt->execute(array(
		"first_name" => $first_name,
		"last_name" => $last_name,
		"birthday" => $birthday,
		"created_at" => getSqlDateForNow(),
	));

	return $result !== false;
}

function getAllMembers(PDO $pdo)
{
	$stmt = $pdo->query("SELECT id, first_name, last_name, birthday, created_at FROM member");
	if ($stmt === false)
	{
		throw new Exception("There was a problem preparing the query");
	}

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteMember(PDO $pdo, $memberID)
{
	$sql = "DELETE FROM member WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	if ($stmt === false)
	{
		throw new Exception("There was a problem preparing the query");
	}
	$stmt->execute(array("id" => $memberID, ));
}
?>

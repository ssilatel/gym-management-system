<?php
require_once "lib/common.php";
require_once "lib/members.php";

session_start();

if (!isLoggedIn())
{
	redirectAndExit("index.php");
}

if ($_POST)
{
	$deleteResponse = $_POST["delete-member"];
	if ($deleteResponse)
	{
		$keys = array_keys($deleteResponse);
		$deleteMemberID = $keys[0];
		if ($deleteMemberID)
		{
			deleteMember(getPDO(), $deleteMemberID);
			redirectAndExit("members.php");
		}
	}
}

$pdo = getPDO();
$members = getAllMembers($pdo);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Members - Gym Management System</title>
		<?php require "templates/header.php" ?>
	</head>
	<body>
		<div class="container">
			<?php require "templates/navbar.php" ?>

			<div class="container mt-5">
				<a class="btn btn-primary" href="add-member.php">Add Member</a>
			</div>

			<div class="container mt-5">
				<form method="post">
					<div class="table-responsive">
						<table class="table table-hover table-bordered align-middle" id="member-list">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Birthday</th>
									<th>Created</th>
								</tr>
							</thead>
							<tbody class="table-group-divider">
								<?php foreach ($members as $member): ?>
									<tr>
										<td><?php echo htmlEscape($member["first_name"]) ?></td>
										<td><?php echo htmlEscape($member["last_name"]) ?></td>
										<td><?php echo convertSqlDate($member["birthday"]) ?></td>
										<td><?php echo convertSqlDatetime($member["created_at"]) ?></td>
										<td><input class="btn btn-danger" type="submit" name="delete-member[<?php echo $member['id'] ?>]" value="Delete"></td>
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


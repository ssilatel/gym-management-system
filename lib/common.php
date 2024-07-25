<?php
/**
 * Gets the root path of the project
 *
 * @return string
 */
function getRootPath()
{
	return realpath(__DIR__ . "/..");
}

/**
 * Gets the full path for the database file
 *
 * @return string
 */
function getDatabasePath()
{
	return getRootPath() . "/data/data.sqlite";
}

/**
 * Gets the DSN for the SQLite connection
 *
 * @return string
 */
function getDSN()
{
	return "sqlite:" . getDatabasePath();
}

/**
 * Gets the PDO object for database access
 *
 * @return PDO
 */
function getPDO()
{
	$pdo = new PDO(getDSN());
	
	$result = $pdo->query("PRAGMA foreign_keys = ON");
	if ($result === false)
	{
		throw new Exception("Could not turn on foreign key constraints");
	}

	return $pdo;
}

/**
 * Escapes HTML so it is safe to output
 *
 * @param string $html
 * @return string
 */
function htmlEscape($html)
{
	return htmlspecialchars($html, ENT_HTML5, "UTF-8");
}

function convertSqlDatetime($sqlDate)
{
	$date = DateTime::createFromFormat("Y-m-d H:i:s", $sqlDate);

	return $date->format("d M Y, H:i");
}

function convertSqlDate($sqlDate)
{
	$date = DateTime::createFromFormat("Y-m-d", $sqlDate);

	return $date->format("d M Y");
}

function getSqlDateForNow()
{
	return date("Y-m-d H:i:s");
}

function redirectAndExit($script)
{
	$relativeUrl = $_SERVER["PHP_SELF"];
	$urlFolder = substr($relativeUrl, 0, strrpos($relativeUrl, "/") + 1);

	$host = $_SERVER["HTTP_HOST"];
	$fullUrl = "http://" . $host . $urlFolder .$script;
	header("Location: " . $fullUrl);
	exit();
}

function tryLogin(PDO $pdo, $username, $password)
{
	$sql = "SELECT password FROM employee WHERE username = :username";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array("username" => $username, ));

	$hash = $stmt->fetchColumn();
	$success = password_verify($password, $hash);

	return $success;
}

function login($username)
{
	session_regenerate_id();

	$_SESSION["logged_in_username"] = $username;
}

function logout()
{
	unset($_SESSION["logged_in_username"]);
}

function isLoggedIn()
{
	return isset($_SESSION["logged_in_username"]);
}

function getAuthUser()
{
	return isLoggedIn() ? $_SESSION["logged_in_username"] : null;
}
?>

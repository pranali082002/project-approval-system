<?php


define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
define("DB_DATABASE", "project");


$mysqli = new mysqli("127.0.0.1", "root", "Pranali@123", "project");
if($mysqli->connect_error)
{
	die("connection failed :" .$mysqli->connect_error);
}
else{
	return $mysqli;
}

?>
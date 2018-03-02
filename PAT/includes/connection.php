<?php

$server     = "johnstrackcom.domaincommysql.com";
$username   = "steve";
$password   = "loser";
$db         = "pat";

// Create a connection
$conn = mysqli_connect ($server, $username, $password, $db);

// Check connection
if (!$conn) {
	die ("Connection failed: " . mysqli_connect_error());
}

?>
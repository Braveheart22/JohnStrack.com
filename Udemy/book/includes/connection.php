<?php

$server     = "johnstrackcom.domaincommysql.com";
$username   = "john";
$password   = "winger11";
$db         = "db_clientaddressbook";

// Create a connection
$conn = mysqli_connect ($server, $username, $password, $db);

// Check connection
if (!$conn) {
	die ("Connection failed: " . mysqli_connect_error());
}

?>
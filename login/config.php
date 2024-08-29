<?php
date_default_timezone_set('Asia/Jakarta');

// Create a connection to the MySQL database
$connection = new mysqli("localhost", "root", "", "toko");

// Check if the connection was successful
if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error . "<br>");
}

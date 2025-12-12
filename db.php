<?php
// Database configuration
$servername = "localhost";
$username   = "root";
$password   = "03051017f";
$database   = "todo_app";

// Create MySQLi connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>

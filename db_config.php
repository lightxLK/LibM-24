<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "library_db";
$port = 3307; // Updated port number for phpMyAdmin

// Create a database connection
$conn = new mysqli($host, $user, $password, $database, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
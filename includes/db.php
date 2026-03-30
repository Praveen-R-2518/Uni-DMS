<?php
// db.php - Database connection using MySQLi
// Update these variables with your database credentials
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'uni_dms';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// Use $conn in your queries
?>
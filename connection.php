<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'shopping_site';

$conn = new mysqli($host, $user, $password, $db_name);

// Check the connection
if ($conn->connect_error) {
    error_log('Database connection failed: ' . $conn->connect_error); // Log error
    die('Error establishing a database connection.'); // General error for users
}
?>

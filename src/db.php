<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "db"; // Replace with your MySQL server hostname
$username = "jravich";  // Replace with your MySQL username
$password = "jravich@123";  // Replace with your MySQL password
$dbname = "jravich_db";  // Replace with the name of your MySQL database

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Database connected successfully";
}
?>

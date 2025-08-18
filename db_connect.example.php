<?php
// db_connect.example.php
// Copy this file to db_connect.php and update with your real credentials

$servername = "localhost";   // Usually "localhost" for XAMPP
$username   = "root";        // Your MySQL username
$password   = "";            // Your MySQL password (default is empty in XAMPP)
$database   = "native_doctors_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$host = "localhost";
$user = "root";
$password = "Pastor7chris127$";

// Step 1: Connect to MySQL server
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Create the database
$sql = "CREATE DATABASE IF NOT EXISTS native_doctors";
if ($conn->query($sql) === TRUE) {
    echo "✅ Database 'native_doctors' created successfully.<br>";
} else {
    echo "❌ Error creating database: " . $conn->error;
}

$conn->close();
?>

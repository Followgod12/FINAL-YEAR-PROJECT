<?php
$host = "localhost";
$username = "root";
$password = "Pastor7chris127$"; // Use the correct MySQL root password
$dbname = "native_doctors";
$port = 3307; // Your custom MySQL port

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
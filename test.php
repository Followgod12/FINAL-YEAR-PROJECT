<?php
$host = "localhost";
$username = "root";
$password = "Pastor7chris127$";
$dbname = "native_doctors";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected successfully!";
?>

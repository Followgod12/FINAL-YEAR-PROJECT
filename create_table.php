<?php
$host = "localhost";
$user = "root";
$password = "Pastor7chris127$";
$database = "native_doctors";

// Connect to the newly created database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    specialization VARCHAR(100),
    address TEXT,
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "✅ Table 'doctors' created successfully.";
} else {
    echo "❌ Error creating table: " . $conn->error;
}

$conn->close();
?>

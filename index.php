<?php
require 'db_connect.php'; // Use this instead of repeating mysqli code

$success = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $specialty = $_POST['specialty'];
  $location = $_POST['location'];

  $sql = "INSERT INTO doctors (name, specialty, location) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $name, $specialty, $location);

  if ($stmt->execute()) {
    $success = "Doctor registered successfully!";
  } else {
    $success = "Error: " . $stmt->error;
  }

  $stmt->close();
}
?>

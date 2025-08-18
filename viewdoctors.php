<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM native_doctors ORDER BY full_name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Native Doctors</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 30px;
    }

    h2 {
      text-align: center;
      color: #2e7d32;
      margin-bottom: 30px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #2e7d32;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .nav {
      text-align: center;
      margin-bottom: 20px;
    }

    .nav a {
      margin: 0 15px;
      text-decoration: none;

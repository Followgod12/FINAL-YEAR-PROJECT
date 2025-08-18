<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

include 'db_connect.php';

$search = $_GET['search'] ?? '';
$query = "SELECT * FROM native_doctors WHERE full_name LIKE ? OR location LIKE ? OR specialty LIKE ?";
$stmt = $conn->prepare($query);
$term = "%$search%";
$stmt->bind_param("sss", $term, $term, $term);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Native Doctors</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 20px; }
    h2 { color: #2e7d32; }
    input[type="text"] {
      padding: 10px;
      width: 300px;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
    }
    th {
      background-color: #e0f2f1;
    }
  </style>
</head>
<body>
  <h2>All Registered Native Doctors</h2>
  <form method="get">
    <input type="text" name="search" placeholder="Search by name, location, or specialty" value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
  </form>
  <table>
    <tr>
      <th>Full Name</th>
      <th>Specialty</th>
      <th>Location</th>
      <th>Phone Number</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['full_name']) ?></td>
        <td><?= htmlspecialchars($row['specialty']) ?></td>
        <td><?= htmlspecialchars($row['location']) ?></td>
        <td><?= htmlspecialchars($row['phone_number']) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>

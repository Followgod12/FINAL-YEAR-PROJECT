<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Connect to DB
$host = "localhost";
$user = "root";
$password = "Pastor7chris127$"; // Use your actual password
$dbname = "native_doctors";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM native_doctors WHERE id = $id");
    header("Location: admin_dashboard.php");
    exit();
}

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sql = "SELECT * FROM native_doctors WHERE 
    fullname LIKE '%$search%' OR 
    email LIKE '%$search%' OR 
    nin LIKE '%$search%' OR 
    dob LIKE '%$search%' OR 
    lga LIKE '%$search%' OR 
    lga_residence LIKE '%$search%' OR 
    state LIKE '%$search%' OR 
    state_residence LIKE '%$search%' OR 
    village_chief LIKE '%$search%' OR 
    village_chief_phone LIKE '%$search%' OR 
    village_chief_nin LIKE '%$search%' OR 
    shrine_address LIKE '%$search%' OR 
    family_phone1 LIKE '%$search%' OR 
    family_nin1 LIKE '%$search%' OR 
    family_phone2 LIKE '%$search%' OR 
    family_nin2 LIKE '%$search%'
ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Native Doctors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #e8f5e9;
        }
        .header {
            background: #2e7d32;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logout {
            background: #c62828;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
        .container {
            padding: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        button[type="submit"] {
            padding: 10px 15px;
            background: #388e3c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #c8e6c9;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #66bb6a;
            color: white;
        }
        tr:nth-child(even) {
            background: #f1f8e9;
        }
        .btn {
            padding: 6px 10px;
            border: none;
            color: white;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 2px;
            transition: transform 0.2s ease;
        }
        .btn:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }
        .edit {
            background: linear-gradient(90deg, #43a047, #2e7d32);
        }
        .delete {
            background: linear-gradient(90deg, #e53935, #b71c1c);
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Admin Dashboard - Native Doctors</h2>
    <a href="admin_logout.php" class="logout">Logout</a>
</div>

<div class="container">
    <h3>Registered Native Doctors</h3>
    <form method="get">
        <input type="text" name="search" placeholder="Search any field..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>

    <table>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>NIN</th>
            <th>DOB</th>
            <th>LGA</th>
            <th>LGA of Residence</th>
            <th>State</th>
            <th>State of Residence</th>
            <th>Village Chief</th>
            <th>Chief Phone</th>
            <th>Chief NIN</th>
            <th>Shrine Address</th>
            <th>Family Phone 1</th>
            <th>Family NIN 1</th>
            <th>Family Phone 2</th>
            <th>Family NIN 2</th>
            <th>Actions</th>
        </tr>
        <?php
        $sn = 1;
        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $sn++ ?></td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['nin']) ?></td>
                <td><?= htmlspecialchars($row['dob']) ?></td>
                <td><?= htmlspecialchars($row['lga']) ?></td>
                <td><?= htmlspecialchars($row['lga_residence']) ?></td>
                <td><?= htmlspecialchars($row['state']) ?></td>
                <td><?= htmlspecialchars($row['state_residence']) ?></td>
                <td><?= htmlspecialchars($row['village_chief']) ?></td>
                <td><?= htmlspecialchars($row['village_chief_phone']) ?></td>
                <td><?= htmlspecialchars($row['village_chief_nin']) ?></td>
                <td><?= htmlspecialchars($row['shrine_address']) ?></td>
                <td><?= htmlspecialchars($row['family_phone1']) ?></td>
                <td><?= htmlspecialchars($row['family_nin1']) ?></td>
                <td><?= htmlspecialchars($row['family_phone2']) ?></td>
                <td><?= htmlspecialchars($row['family_nin2']) ?></td>
                <td>
                    <a href="edit_doctor.php?id=<?= $row['id'] ?>'>Edit</a> title="Edit">✏️</a>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('⚠️ WARNING:\n\nAre you sure you want to delete this native doctor\'s record?\n\nThis action is permanent and cannot be undone.');" class="btn delete" title="Delete">🗑️</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>

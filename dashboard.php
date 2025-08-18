<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: registerdoctor.php");
    exit();
}

// DB CONNECT
$host = "localhost";
$user = "root";
$password = "Pastor7chris127$";
$dbname = "native_doctors";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// HANDLE FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['fullname'])) {
    $stmt = $conn->prepare("INSERT INTO native_doctors 
        (fullname, email, nin, dob, gender, state, state_residence, lga, lga_residence, village, village_chief, village_chief_phone, village_chief_nin, shrine_address, family_phone1, family_nin1, family_phone2, family_nin2)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssssssss", 
        $_POST['fullname'], $_POST['email'], $_POST['nin'], $_POST['dob'], $_POST['gender'], $_POST['state'], $_POST['state_residence'], $_POST['lga'],
        $_POST['lga_residence'], $_POST['village'], $_POST['village_chief'], $_POST['village_chief_phone'], $_POST['village_chief_nin'],
        $_POST['shrine_address'], $_POST['family_phone1'], $_POST['family_nin1'], $_POST['family_phone2'], $_POST['family_nin2']
    );
    $stmt->execute();
    $stmt->close();
}

// STATS
$totalDoctors = $conn->query("SELECT COUNT(*) as total FROM native_doctors")->fetch_assoc()['total'] ?? 0;
$maleDoctors = $conn->query("SELECT COUNT(*) as total FROM native_doctors WHERE gender = 'Male'")->fetch_assoc()['total'] ?? 0;
$femaleDoctors = $conn->query("SELECT COUNT(*) as total FROM native_doctors WHERE gender = 'Female'")->fetch_assoc()['total'] ?? 0;

$villageData = $conn->query("SELECT village, COUNT(*) as count FROM native_doctors GROUP BY village")->fetch_all(MYSQLI_ASSOC);
$lgaData = $conn->query("SELECT lga, COUNT(*) as count FROM native_doctors GROUP BY lga")->fetch_all(MYSQLI_ASSOC);
$stateData = $conn->query("SELECT state, COUNT(*) as count FROM native_doctors GROUP BY state")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nigerian Native Doctors Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('forest.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #f6f7f6ff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            padding: 40px 20px;
        }
        h1 {
            text-align: center;
            color: #f7f8f7ff;
            margin-bottom: 40px;
        }
        .card, .stat-box {
            color: #fdfffeff;
        }
        .card {
            background-color: rgba(18, 78, 21, 0.85);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h2 {
            color: #f3f5f3ff;
            margin-bottom: 15px;
        }
        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
        }
        .stat-box {
            background: #049904ff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            width: 220px;
            box-shadow: 0 4px 4px rgba(193, 247, 67, 1);
            animation: bounce 2s infinite;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-block-start: 1px;
        }
        th {
            background-color: #366904ff;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            background-color: #049904ff;
            color: white;
            border: 1px solid #0c0c0cff;
            padding: 10px;
            text-align: left;
        }
        .edit-btn {
            background: #f2b705;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .edit-btn:hover {
            background: #d29c03;
        }
        footer {
            text-align: center;
            padding: 20px;
            background: #047a08ff;
            color: #fffffcff;
            font-weight: bold;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .logout-btn {
            position: fixed;
            top: 15px;
            right: 20px;
            z-index: 1000;
        }
        .logout-btn button {
            background-color: #ff3333;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form method="post" class="logout-btn">
    <button type="submit" name="logout">Logout</button>
</form>

<div class="container">
    <h1>Nigerian Native Doctors Dashboard</h1>

    <div class="card">
        <h2>📊 Dashboard Statistics</h2>
        <div class="stats-grid">
            <div class="stat-box">👨‍⚕️ Total Doctors<br><?= $totalDoctors ?></div>
            <div class="stat-box">🧍 Male Doctors<br><?= $maleDoctors ?></div>
            <div class="stat-box">🧍‍♀️ Female Doctors<br><?= $femaleDoctors ?></div>
            <div class="stat-box">🏘️ Villages Covered<br><?= count($villageData) ?></div>
            <div class="stat-box">🏛️ LGAs Covered<br><?= count($lgaData) ?></div>
            <div class="stat-box">🗺️ States Covered<br><?= count($stateData) ?></div>
        </div>

        <h3 style="margin-top: 40px;">📍 Doctors by Village</h3>
        <table>
            <tr><th>Village</th><th>Number of Doctors</th></tr>
            <?php foreach ($villageData as $v): ?>
                <tr><td><?= htmlspecialchars($v['village']) ?></td><td><?= $v['count'] ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="card">
        <h2>🏛️ Doctors by LGA</h2>
        <table>
            <tr><th>LGA</th><th>Number of Doctors</th></tr>
            <?php foreach ($lgaData as $lga): ?>
                <tr><td><?= htmlspecialchars($lga['lga']) ?></td><td><?= $lga['count'] ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="card">
        <h2>🗺️ Doctors by State</h2>
        <table>
            <tr><th>State</th><th>Number of Doctors</th></tr>
            <?php foreach ($stateData as $state): ?>
                <tr><td><?= htmlspecialchars($state['state']) ?></td><td><?= $state['count'] ?></td></tr>
            <?php endforeach; ?>
        </table>
    </div>
     
    <div class="card">
        <h2>✅ Benefits of Native Medicine</h2>
        <p>Native medicine uses locally available herbs and natural remedies to treat illnesses, often with minimal side effects. It's affordable, rooted in practice, and respects patients' spiritual and cultural values.</p>
    </div>

    <div class="card">
        <h2>📜 History of Native Medicine</h2>
        <p>Before modern medicine, native doctors served as healers, midwives, and cultural leaders. Their legacy continues to support healthcare in underserved communities.</p>
    </div>

    <div class="card">
        <h2>🛡️ Why Regulation Is Important</h2>
        <p>Regulation ensures safety, credibility, and cooperation with modern medicine. It prevents misuse and protects communities from criminal elements posing as healers.</p>
    </div>
</div>

<footer>
    Thank you for registering. Let’s build trust in native healing together.
</footer>

</body>
</html>

<?php
$host = "localhost";
$user = "root";
$password = "Pastor7chris127$";
$dbname = "native_doctors";
$conn = new mysqli($host, $user, $password, $dbname);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM native_doctors WHERE id = ?;");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();
    if (!$doctor) {
        echo "Doctor not found.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $nin = $_POST['nin'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $state = $_POST['state'];
        $lga = $_POST['lga'];
        $state_residence = $_POST['state_residence'];
        $lga_residence = $_POST['lga_residence'];
        $village_chief = $_POST['village_chief'];
        $village_chief_phone = $_POST['village_chief_phone'];
        $village_chief_nin = $_POST['village_chief_nin'];
        $shrine_address = $_POST['shrine_address'];
        $family_phone1 = $_POST['family_phone1'];
        $family_nin1 = $_POST['family_nin1'];
        $family_phone2 = $_POST['family_phone2'];
        $family_nin2 = $_POST['family_nin2'];

        $stmt = $conn->prepare("UPDATE native_doctors SET fullname=?, email=?, nin=?, dob=?, gender=?, state=?, lga=?, state_residence=?, lga_residence=?, village_chief=?, village_chief_phone=?, village_chief_nin=?, shrine_address=?, family_phone1=?, family_nin1=?, family_phone2=?, family_nin2=? WHERE id=?");

        $stmt->bind_param("sssssssssssssssssi", $fullname, $email, $nin, $dob, $gender, $state, $lga, $state_residence, $lga_residence, $village_chief, $village_chief_phone, $village_chief_nin, $shrine_address, $family_phone1, $family_nin1, $family_phone2, $family_nin2, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: dashboard.php?updated=1");
        exit();
    }
} else {
    echo "Invalid access.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Native Doctor</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
    }
    .form-box {
      width: 500px;
      background: white;
      padding: 20px;
      margin: 50px auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      border-radius: 10px;
    }
    h3 {
      text-align: center;
      color: #0a9396;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background: #0a9396;
      color: white;
      font-weight: bold;
      cursor: pointer;
      margin-top: 20px;
      border: none;
    }
    input[type="submit"]:hover {
      background: #007b7a;
    }
  </style>
</head>
<body>

<div class="form-box">
  <h3>Edit Native Doctor</h3>
  <form method="POST">
    <label>Full Name</label>
    <input type="text" name="fullname" value="<?= htmlspecialchars($doctor['fullname']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($doctor['email']) ?>" required>

    <label>NIN</label>
    <input type="text" name="nin" value="<?= htmlspecialchars($doctor['nin']) ?>" required>

    <label>Date of Birth</label>
    <input type="date" name="dob" value="<?= htmlspecialchars($doctor['dob']) ?>" required>

    <label>Gender</label>
    <select name="gender" required>
      <option value="">--Select Gender--</option>
      <option value="Male" <?= $doctor['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
      <option value="Female" <?= $doctor['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <label>State</label>
    <input type="text" name="state" value="<?= htmlspecialchars($doctor['state']) ?>" required>

    <label>LGA</label>
    <input type="text" name="lga" value="<?= htmlspecialchars($doctor['lga']) ?>" required>

    <label>State of Residence</label>
    <input type="text" name="state_residence" value="<?= htmlspecialchars($doctor['state_residence']) ?>" required>

    <label>LGA of Residence</label>
    <input type="text" name="lga_residence" value="<?= htmlspecialchars($doctor['lga_residence']) ?>" required>

    <label>Village Chief Name</label>
    <input type="text" name="village_chief" value="<?= htmlspecialchars($doctor['village_chief']) ?>" required>

    <label>Village Chief Phone</label>
    <input type="text" name="village_chief_phone" value="<?= htmlspecialchars($doctor['village_chief_phone']) ?>" required>

    <label>Village Chief NIN</label>
    <input type="text" name="village_chief_nin" value="<?= htmlspecialchars($doctor['village_chief_nin']) ?>" required>

    <label>Shrine Address</label>
    <input type="text" name="shrine_address" value="<?= htmlspecialchars($doctor['shrine_address']) ?>" required>

    <label>Family Member 1 Phone</label>
    <input type="text" name="family_phone1" value="<?= htmlspecialchars($doctor['family_phone1']) ?>" required>

    <label>Family Member 1 NIN</label>
    <input type="text" name="family_nin1" value="<?= htmlspecialchars($doctor['family_nin1']) ?>" required>

    <label>Family Member 2 Phone</label>
    <input type="text" name="family_phone2" value="<?= htmlspecialchars($doctor['family_phone2']) ?>" required>

    <label>Family Member 2 NIN</label>
    <input type="text" name="family_nin2" value="<?= htmlspecialchars($doctor['family_nin2']) ?>" required>

    <input type="submit" value="Update">
  </form>
</div>

</body>
</html>

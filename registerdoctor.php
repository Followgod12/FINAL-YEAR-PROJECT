<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $user = "root";
    $password = "Pastor7chris127$";
    $dbname = "native_doctors";

    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $nin = $_POST['nin'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $state = $_POST['state'];
    $state_residence = $_POST['state_residence'];
    $lga = $_POST['lga'];
    $lga_residence = $_POST['lga_residence'];
    $village_chief = $_POST['village_chief'];
    $village_chief_phone = $_POST['village_chief_phone'];
    $village_chief_nin = $_POST['village_chief_nin'];
    $shrine_address = $_POST['shrine_address'];
    $family_phone1 = $_POST['family_phone1'];
    $family_nin1 = $_POST['family_nin1'];
    $family_phone2 = $_POST['family_phone2'];
    $family_nin2 = $_POST['family_nin2'];

    // Prepare SQL
    $sql = "INSERT INTO native_doctors (
        fullname, email, nin, dob, gender, state, state_residence, lga, lga_residence, 
        village_chief, village_chief_phone, village_chief_nin, shrine_address, 
        family_phone1, family_nin1, family_phone2, family_nin2
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssssss",
        $fullname, $email, $nin, $dob, $gender, $state, $state_residence,
        $lga, $lga_residence, $village_chief, $village_chief_phone, $village_chief_nin,
        $shrine_address, $family_phone1, $family_nin1, $family_phone2, $family_nin2
    );

    if ($stmt->execute()) {
        echo "<script>alert('✅ Registration successful. Redirecting to dashboard...');</script>";
        echo "<meta http-equiv='refresh' content='2;url=dashboard.php'>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Native Doctor Registration</title>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background: url('green-hills.jpg') center/cover no-repeat;
      margin: 0;
      padding: 0;
      display: flex;
      height: 100vh;
    }

    .container {
      display: flex;
      width: 100%;
      padding: 20px;
      box-sizing: border-box;
    }

    .header {
       flex-shrink: 0;
  width: 300px;
  height: 80vh; /* Reduced from 95vh */
  background: rgba(27, 94, 32, 0.7);
  padding: 20px 15px;
  border-radius: 10px;
  color: #ffffff;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  animation: bounce 2s infinite;
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
  align-items: center;
  text-align: center;
    }

    .header h1 {
      font-size: 32px;
      font-family: 
      margin: 0;
    }

    .header .to {
      font-size: 24px;
      font-family: 'Great Vibes', cursive;
      margin-top: -10px;
      margin-bottom: 10px;
    }

    .header-box-title {
      background: rgba(255, 255, 255, 0.15);
      padding: 15px;
      border-radius: 15px;
      font-size: 22px;
      font-weight: bold;
      border: 2px solid #fff;
      backdrop-filter: blur(4px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      text-transform: uppercase;
    }

    .header p {
      font-size: 16px;
      line-height: 1.6;
    }

    @keyframes bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    .form-box {
    width: 50%; /* Reduced from 65% */
  padding: 30px 50px;
  background: rgba(224, 242, 241, 0.8);
  border-radius: 20px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.1);
  margin-left: 20px;
  overflow-y: auto;
  color: #004d40;
    }

    .form-box h3 {
     margin-bottom: 20px;
  color: #004d40;
  font-size: 28px;
  font-weight: 800;
  text-transform: uppercase;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  letter-spacing: 1px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 10px;
      font-weight: bold;
      color: #00695c;
    }

    input {
      padding: 10px;
      margin-top: 5px;
      border: 2px solid #0a9396;
      border-radius: 10px;
      color: #004d40;
      background-color: #ffffff;
    }

    input::placeholder {
      color: #80cbc4;
    }

    button {
      margin-top: 20px;
      padding: 12px;
      background-color: #0a9396;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #007b7f;
    }

    @media screen and (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .header,
      .form-box {
        width: 100%;
        margin: 0 0 20px 0;
      }

      .form-box {
        margin-left: 0;
      }

      .header {
        height: auto;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="header">
    <h1>WELCOME</h1>
    <div class="to">TO</div>
    <div class="header-box-title">NIGERIAN NATIVE DOCTORS REGISTRATION PORTAL</div>
    <p>Please fill in the form below with accurate information.</p>
    <p>Become part of the verified and trusted native healer registry in Nigeria.</p>
  </div>

  <div class="form-box">
    <h3>Register a Native Doctor</h3>
    <form action="registerdoctor.php" method="POST">
      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" required>
      
<label for="gender">Gender</label>
     <div style="display: flex; gap: 20px; margin-top: 5px; margin-bottom: 10px;">
  <label style="display: flex; align-items: center; gap: 5px; font-weight: normal; color: #004d40;">
    <input type="radio" name="gender" value="Male" required style="accent-color: #0a9396;"> Male
  </label>
  <label style="display: flex; align-items: center; gap: 5px; font-weight: normal; color: #004d40;">
    <input type="radio" name="gender" value="Female" required style="accent-color: #0a9396;"> Female
  </label>
</div>

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>

      <label for="nin">NIN</label>
      <input type="text" id="nin" name="nin" required>

      <label for="dob">Date of Birth</label>
      <input type="date" id="dob" name="dob" required>

      <label for="state">State</label>
      <input type="text" id="state" name="state" required>

      <label for="lga">LGA</label>
      <input type="text" id="lga" name="lga" required>

      <label for="state_residence">State of Residence</label>
      <input type="text" id="state_residence" name="state_residence" required>

      <label for="lga_residence">LGA of Residence</label>
      <input type="text" id="lga_residence" name="lga_residence" required>

      <label for="village_chief">Village Chief Name</label>
      <input type="text" id="village_chief" name="village_chief" required>

      <label for="village_chief_phone">Village Chief Phone</label>
      <input type="text" id="village_chief_phone" name="village_chief_phone" required>

      <label for="village_chief_nin">Village Chief NIN</label>
      <input type="text" id="village_chief_nin" name="village_chief_nin" required>

      <label for="shrine_address">Shrine Address</label>
      <input type="text" id="shrine_address" name="shrine_address" required>

      <label for="family_phone1">Family Member 1 Phone</label>
      <input type="text" id="family_phone1" name="family_phone1" required>

      <label for="family_nin1">Family Member 1 NIN</label>
      <input type="text" id="family_nin1" name="family_nin1" required>

      <label for="family_phone2">Family Member 2 Phone</label>
      <input type="text" id="family_phone2" name="family_phone2" required>

      <label for="family_nin2">Family Member 2 NIN</label>
      <input type="text" id="family_nin2" name="family_nin2" required>

      <button type="submit">Submit Registration</button>
    </form>
  </div>
</div>

</body>
</html>

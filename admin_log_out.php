<?php
session_start();
session_unset();
session_destroy();
header("Location: admin_login.php"); // ✅ Change this to match your real admin login file
exit();

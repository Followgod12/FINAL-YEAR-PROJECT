<?php
session_start();
session_unset();
session_destroy();
header("Location: registerdoctor.php"); // Change to your actual registration file
exit();

<?php
session_start();
// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Redirect to user dashboard if the user is not an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../user_files/user_dashboard.php");
    exit();
}
?>

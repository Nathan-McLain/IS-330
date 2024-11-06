<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php"); // Redirect non-admins to the main dashboard
    exit();
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
</body>
</html>
<?php include 'nav.php'; ?>
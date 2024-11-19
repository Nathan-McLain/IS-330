<?php include 'check_admin.php'; // Ensure only logged-in admins can access ?>
<link rel="stylesheet" href="styles.css">
<!-- navbar.php -->
<nav>
    <ul style="display: flex; justify-content: space-between; align-items: center;">
        <div style="display: flex; gap: 15px;">
        <li><a href="admin_dashboard.php">Home</a></li>
        <li><a href="add_episode.php">Add Episode</a></li>
        <li><a href="add_character.php">Add Character</a></li>
        <li><a href="users.php">Manage Users</a></li>
        <li><a href="../logout.php">Logout</a></li>
</div>
         <!-- Display the current username on the right -->
        <div>
            <?php if (isset($_SESSION['username'])): ?>
                <li style="list-style: none; color: #333;">
                    Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                </li>
            <?php endif; ?>
        </div>
    </ul>
</nav>


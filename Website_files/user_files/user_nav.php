<!-- navbar.php -->
<?php 
session_start(); 
?>
<nav>
    <ul style="display: flex; justify-content: space-between; align-items: center;">
        <div style="display: flex; gap: 15px;">
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="user_character.php">Characters</a></li>
            <li><a href="user_episodes.php">Episodes</a></li>
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
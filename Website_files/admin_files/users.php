<!-- users.php -->
<h1>Manage Users</h1>

<?php 
    include 'nav.php';
    include '../db_connect.php';

// Handle any deletion request
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM Users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

// Retrieve all users
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
?>

<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['role']); ?></td>
                <td>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <input type="submit" name="delete_user" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
$conn->close();
?>

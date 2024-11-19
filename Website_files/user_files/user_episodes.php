<?php
include '../db_connect.php';
include 'user_nav.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Handle search for episodes
$search_term = '';
if (isset($_POST['search_episode'])) {
    $search_term = $_POST['search_term'];
    $sql = "SELECT title, episode_number, air_date, duration FROM episodes 
            WHERE title LIKE '%$search_term%' OR episode_number LIKE '%$search_term%'";
} else {
    // Default query to show all episodes
    $sql = "SELECT title, episode_number, air_date, duration FROM episodes";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Episodes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">

<h1>Episodes</h1>

<!-- Search and Clear Form -->
<form method="POST" action="user_episodes.php">
    <input type="text" name="search_term" placeholder="Search by episode name or number" value="<?php echo htmlspecialchars($search_term); ?>">
    <input type="submit" name="search_episode" value="Search">
    <input type="submit" name="clear_search" value="Clear">
</form>

<!-- Display Episodes Table -->
<table>
    <thead>
        <tr>
            <th>Episode Name</th>
            <th>Episode Number</th>
            <th>Air Date</th>
            <th>Duration</th>
        </tr>
    </thead>
    <body>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["episode_number"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["air_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["duration"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No episodes found.</td></tr>";
        }
        ?>
        <div class="container">
    </body>
</table>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>

<?php
include '../db_connect.php';
include 'user_nav.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Handle search for characters
$search_term = '';
if (isset($_POST['search_character'])) {
    $search_term = $_POST['search_term'];
    $sql = "SELECT name, description, crew, devil_fruit, haki_user FROM characters 
            WHERE name LIKE '%$search_term%' OR devil_fruit LIKE '%$search_term%'";
} else {
    // Default query to show all characters
    $sql = "SELECT name, description, crew, devil_fruit, haki_user FROM characters";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Characters</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Characters</h2>

    <!-- Search and Clear Form -->
    <form method="POST" action="user_character.php">
        <input type="text" name="search_term" placeholder="Search by character name or Devil fruit" value="<?php echo htmlspecialchars($search_term); ?>">
        <input type="submit" name="search_character" value="Search">
        <input type="submit" name="clear_search" value="Clear">
    </form>

    <!-- Display Character Cards -->
    <?php
    if ($result->num_rows > 0) {
        while ($character = $result->fetch_assoc()) {
            echo "<div class='character-card'>";
            echo "<h3>" . htmlspecialchars($character['name']) . "</h3>";
            echo "<p>" . htmlspecialchars($character['description']) . "</p>";
            echo "<p>Crew: " . htmlspecialchars($character['crew']) . "</p>";
            echo "<p>Devil Fruit: " . htmlspecialchars($character['devil_fruit']) . "</p>";
            echo "<p>Haki User: " . ($character['haki_user'] ? 'Yes' : 'No') . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No characters found.</p>";
    }
    ?>
</div>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>

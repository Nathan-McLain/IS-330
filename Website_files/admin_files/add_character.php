<h1>Characters List</h1>

<link rel="stylesheet" href="styles.css">

<?php include 'nav.php';
      include '../db_connect.php';

// ADD a new character
if (isset($_POST['add_character'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $devil_fruit = $_POST['devil_fruit'];
    $crew = $_POST['crew'];
    $haki_user = isset($_POST['haki_user']) ? 1 : 0;
    $bounty = $_POST['bounty'];

    $sql = "INSERT INTO Characters (name, description, devil_fruit, crew, haki_user, bounty) 
            VALUES ('$name', '$description', '$devil_fruit', '$crew', '$haki_user', '$bounty')";

    if ($conn->query($sql) === TRUE) {
        echo "New character added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// DELETE a character
if (isset($_POST['delete_character'])) {
    $character_id = $_POST['character_id'];

    $sql = "DELETE FROM Characters WHERE character_id='$character_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Character deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// SEARCH for characters
if (isset($_POST['search_character'])) {
    $search_term = $_POST['search_term'];
    $sql = "SELECT * FROM Characters WHERE name LIKE '%$search_term%' OR crew LIKE '%$search_term%'";
} else {
    // Default query to show all characters
    $sql = "SELECT * FROM Characters";
}

$result = $conn->query($sql);
?>

<!-- Search Form -->
<form method="POST" action="">
    <input type="text" name="search_term" placeholder="Search by character name or crew">
    <input type="submit" name="search_character" value="Search">
</form>

<!-- Add New Character Form -->
<form method="POST" action="">
    <h3>Add New Character</h3>
    <input type="text" name="name" placeholder="Character Name" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="text" name="devil_fruit" placeholder="Devil Fruit">
    <input type="text" name="crew" placeholder="Crew">
    <label>Haki User: <input type="checkbox" name="haki_user"></label>
    <input type="number" name="bounty" placeholder="Bounty" required>
    <input type="submit" name="add_character" value="Add Character">
</form>

<!-- Display Characters Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Devil Fruit</th>
            <th>Crew</th>
            <th>Haki User</th>
            <th>Bounty</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["character_id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["devil_fruit"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["crew"]) . "</td>";
                echo "<td>" . ($row["haki_user"] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . number_format($row["bounty"]) . "</td>";
                echo "<td>
                    <a href='edit_character.php?character_id=" . $row["character_id"] . "'>Edit</a>
                    <form method='POST' action='' style='display:inline-block;'>
                        <input type='hidden' name='character_id' value='" . $row["character_id"] . "'>
                        <input type='submit' name='delete_character' value='Delete'>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No results found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conn->close();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "one_piece_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['character_id'])) {
    $character_id = $_GET['character_id'];
    $sql = "SELECT * FROM Characters WHERE character_id = '$character_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $character = $result->fetch_assoc();
    } else {
        echo "Character not found.";
        exit;
    }
} else {
    echo "No character selected.";
    exit;
}

if (isset($_POST['update_character'])) {
    $character_id = $_POST['character_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $devil_fruit = $_POST['devil_fruit'];
    $crew = $_POST['crew'];
    $haki_user = isset($_POST['haki_user']) ? 1 : 0; // Checkbox value handling
    $bounty = $_POST['bounty'];

    $sql = "UPDATE Characters SET 
                name='$name', 
                description='$description', 
                devil_fruit='$devil_fruit', 
                crew='$crew', 
                haki_user='$haki_user', 
                bounty='$bounty' 
            WHERE character_id='$character_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Character updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- HTML Form to Edit Character -->
<form method="POST" action="">
    <input type="hidden" name="character_id" value="<?php echo isset($character['character_id']) ? $character['character_id'] : ''; ?>">
    <label>Character Name:</label>
    <input type="text" name="name" value="<?php echo isset($character['name']) ? $character['name'] : ''; ?>" required>
    <label>Description:</label>
    <textarea name="description" required><?php echo isset($character['description']) ? $character['description'] : ''; ?></textarea>
    <label>Devil Fruit:</label>
    <input type="text" name="devil_fruit" value="<?php echo isset($character['devil_fruit']) ? $character['devil_fruit'] : ''; ?>">
    <label>Crew:</label>
    <input type="text" name="crew" value="<?php echo isset($character['crew']) ? $character['crew'] : ''; ?>">
    <label>Haki User:</label>
    <input type="checkbox" name="haki_user" <?php echo isset($character['haki_user']) && $character['haki_user'] ? 'checked' : ''; ?>>
    <label>Bounty:</label>
    <input type="number" name="bounty" value="<?php echo isset($character['bounty']) ? $character['bounty'] : 0; ?>" required>
    <input type="submit" name="update_character" value="Update Character">
</form>

<!-- Button to Return -->
<form action="add_character.php" method="get">
    <input type="submit" value="Return to Chacter list">
</form>

<?php $conn->close(); ?>

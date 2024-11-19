<h1>Episodes List</h1>

<?php 
include 'nav.php';
include '../db_connect.php';

// ADD a new episode
if (isset($_POST['add_episode'])) {
    $title = $_POST['title'];
    $episode_number = $_POST['episode_number'];
    $air_date = $_POST['air_date'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO episodes (title, episode_number, air_date, duration) 
            VALUES ('$title', '$episode_number', '$air_date', '$duration')";

    if ($conn->query($sql) === TRUE) {
        echo "New episode added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// DELETE an episode
if (isset($_POST['delete_episode'])) {
    $episode_id = $_POST['episode_id'];

    $sql = "DELETE FROM episodes WHERE episode_id='$episode_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Episode deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// SEARCH for episodes
if (isset($_POST['search_episode'])) {
    $search_term = $_POST['search_term'];
    $sql = "SELECT * FROM episodes WHERE title LIKE '%$search_term%' OR episode_number LIKE '%$search_term%'";
} else {
    // Default query to show all episodes
    $sql = "SELECT * FROM episodes";
}

$result = $conn->query($sql);
?>
 <link rel="stylesheet" href="styles.css">
<!-- Search Form -->
<form method="POST" action="">
    <input type="text" name="search_term" placeholder="Search by episode name or number">
    <input type="submit" name="search_episode" value="Search">
</form>

<!-- Add New Episode Form -->
<form method="POST" action="">
    <h3>Add New Episode</h3>
    <input type="text" name="title" placeholder="Episode Name" required>
    <input type="number" name="episode_number" placeholder="Episode Number" required>
    <input type="date" name="air_date" placeholder="Air Date" required>
    <input type="text" name="duration" placeholder="Duration" required>
    <input type="submit" name="add_episode" value="Add Episode">
</form>

<!-- Display Episodes Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Episode Name</th>
            <th>Episode Number</th>
            <th>Air Date</th>
            <th>Duration</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["episode_id"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["episode_number"] . "</td>";
                echo "<td>" . $row["air_date"] . "</td>";
                echo "<td>" . $row["duration"] . "</td>";
                echo "<td>
                     <a href='edit_episode.php?episode_id=" . $row["episode_id"] . "'>Edit</a>
                    <form method='POST' action='' style='display:inline-block;'>
                    <input type='hidden' name='episode_id' value='" . $row["episode_id"] . "'>
                    <input type='submit' name='delete_episode' value='Delete'>
                     </form>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
        }
        ?>
    </tbody>
</table>




<?php
$conn->close();
?>
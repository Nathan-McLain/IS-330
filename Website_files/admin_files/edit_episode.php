<?php
include '../db_connect.php';
include 'check_admin.php';

if (isset($_GET['episode_id'])) {
    $episode_id = $_GET['episode_id'];
    $sql = "SELECT * FROM episodes WHERE episode_id = '$episode_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $episode = $result->fetch_assoc();
    } else {
        echo "Episode not found.";
        exit;
    }
}

if (isset($_POST['update_episode'])) {
    $episode_id = $_POST['episode_id'];
    $title = $_POST['title'];
    $episode_number = $_POST['episode_number'];
    $air_date = $_POST['air_date'];
    $duration = $_POST['duration'];

    $sql = "UPDATE episodes SET title='$title', episode_number='$episode_number', air_date='$air_date', duration='$duration' 
            WHERE episode_id='$episode_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Episode updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- HTML Form to Edit Episode -->
<form method="POST" action="">
    <input type="hidden" name="episode_id" value="<?php echo $episode['episode_id']; ?>">
    <label>Episode Name:</label>
    <input type="text" name="title" value="<?php echo $episode['title']; ?>" required>
    <label>Episode Number:</label>
    <input type="number" name="episode_number" value="<?php echo $episode['episode_number']; ?>" required>
    <label>Air Date:</label>
    <input type="date" name="air_date" value="<?php echo $episode['air_date']; ?>" required>
    <label>Duration:</label>
    <input type="text" name="duration" value="<?php echo $episode['duration']; ?>" required>
    <input type="submit" name="update_episode" value="Update Episode">
</form>

<!-- Button to Return Character list -->
<form action="add_episode.php" method="get">
    <input type="submit" value="Return to episode list">
</form>

<?php $conn->close(); ?>
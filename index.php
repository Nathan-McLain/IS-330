<h1>This is a trap</h1>

<?php

  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbname     = "one_piece_db"; 

  // Create connection object
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT name FROM characters";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "Name: " . $row["name"]. "<br>";
    }
  } else {
    echo "0 results";
  }

  $conn->close();

?>

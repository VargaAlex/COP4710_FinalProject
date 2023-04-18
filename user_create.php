

<?php
    // Insert the user into the database
$sql = "INSERT INTO users (u_id) VALUES ('$u_id')";

    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id; // Get the ID of the newly inserted user
        echo "User registered successfully with ID: " . $user_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Retrieve the university information from the database
$sql = "SELECT * FROM University";
$result = $conn->query($sql);

if ($result-> num_rows > 0) {
    // Output the university information in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Admin ID</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["admin_id"] . "</td></tr>";
    }
    echo "</table>";
  } else {
    echo "No groups found";
  }
  
  $conn->close();
?>

<p>Create User</p>
<form action="user_create.php" method="post">
  <label for="University">University:</label>
  <input type="text" id="university" name="university" required>

  <input type="submit" value="Create University">
</form>
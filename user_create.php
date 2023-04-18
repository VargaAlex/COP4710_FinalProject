<?php

include('config.php');

?>

<?php
$u_id; 
$sql = "Select u_id from Users order by u_id DESC LIMIT 1";
    if ($res = mysqli_query($db,$sql)) {
        $user_id = $db->insert_id; // Get the ID of the newly inserted user
        echo "User registered successfully with ID: " . $user_id;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }


// Retrieve the university information from the database
$sql = "SELECT * FROM University";
if ($res = mysqli_query($db,$sql)){
    // Output the university information in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Admin ID</th></tr>";
    while ($row = $res->fetch_assoc()) {
        echo "<tr><td>" . $row["uni_id"] . "</td><td>" . $row["uni_name"] . "</td><td>" . $row["sa_id"] . "</td></tr>";
    }
    echo "</table>";
  } else {
    echo "No groups found";
  }
  
  $db->close();
?>

<p>Create User</p>
<form action="user_create.php" method="post">
  <label for="University">University:</label>
  <input type="text" id="university" name="university" required>

  <input type="submit" value="Create University">
</form>
<?php
include('config.php');
?>

<?php
// Create a new user
$u_id; 
$sql = "Select u_id from Users order by u_id DESC LIMIT 1";
    if ($res = mysqli_query($db,$sql)) {
        $user_id = $db->insert_id; // Get the ID of the newly inserted user
        echo "User registered successfully with ID: " . $user_id;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>

<?php
echo "
<p>
University: 
<select name='uniSelect'>
<option value=''>Select...</option>
";

// List out the universities
$sql = "select uni_id, uni_name from univeristy";
if($res = mysqli_query($db,$sql)) {
   while($row = mysqli_fetch_array($res)) {
    $uni_id = $row[0];
    $uni_name = $row[1];
    echo "
    <option value=$l_id>$l_name</option>
    ";
  }
}

// Create University and SuperAdmin
$sql = "insert into University(uni_name, info) values ('$uni_name', '$info') ";
if($res = mysqli_query($db,$sql)) {
    $sql = "select last_insert_id() ";
    $uni_id;
    $sa_id;
      if($res = mysqli_query($db,$sql)) {
        if($row = mysqli_fetch_array($res)) {
          $uni_id = $row[0];
          $sa_id = $row[3];
        }
      }
      echo "$uni_id
            $sa_id";
}

    echo "
</select>
</p>
<input type = 'hidden' name = 'university' value = 'uniSelect' />
";
?>

<p>If your university is not listed below, create it here</p>
<form action="user_create.php" method="post">
<label>University :</label></label><input type="text" id="university" name="university" required>
<input type= "submit" value="Submit"/><br />
</form>
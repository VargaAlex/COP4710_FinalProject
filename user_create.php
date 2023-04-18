<?php
include('config.php');
?>

<?php
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($db,$_POST['username']);
    $pass = mysqli_real_escape_string($db,$_POST['password']);

    if($name == null) {
      $error = "Username is required.";
    } 
    else if ($pass == null) {
      $error = "Password is required.";
    }
    else {
          $name;
          $pass;
          $sql = "insert into users (pass, name) values ('$pass', '$name')";
          if ($res = mysqli_query($db,$sql)) {
              $u_id = mysqli_insert_id($db); // Get the ID of the newly inserted user
                 echo "User registered successfully with ID: " . $u_id;
          } else {
                 echo "Error adding user: " . mysqli_error($db);
          }
      }
    } 
?>
<html>
<form action="user_create.php" method = "post">
  <h1>Register User</h1>
  <label for="username">Username:</label>
  <input type="text" name="username" id="username" required><br>

  <label for="password">Password:</label>
  <input type="password" name="password" id="password" required><br>

  <h2>Create a new University? If so, enter below</h2>
  <div>
</html>

<?php
    $uni_id;
    $sa_id;
    // List out the universities
    $sql = "select uni_id, uni_name from university";
    if($res = mysqli_query($db,$sql)) {
       while($row = mysqli_fetch_array($res)) {
        $uni_id = $row[0];
        $uni_name = $row[1];
        echo "
        <input type='radio' id='userSelect1' name='register'  value='Yes' />
        <label>Yes </label><input type='text' id='university' name='$uni_name'>
        <input type='radio' id='userSelect2' name='register'  value='No' />
        <label>No </label>
        <select data-label='Available Universities'>
        <option value=''>-- Select University -- </option>
          <option value=$uni_id>$uni_name</option>
        </select>
        </div>
        <input type = 'submit' value = ' Register '/><br />
        <input type = 'hidden' name = 'university' value = '$uni_name' />
        ";
      }
    }
?>
</form>
</html>
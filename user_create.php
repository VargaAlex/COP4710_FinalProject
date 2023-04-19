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
          $uni_id;
          $sql = "insert into users (pass, name) values ('$pass', '$name')";
          if ($res = mysqli_query($db,$sql)) {
              $u_id = mysqli_insert_id($db); // Get the ID of the newly inserted user
                 echo "User registered successfully with ID: " . $u_id;
                 
                 $uni_name = mysqli_real_escape_string($db,$_POST['uni_name']);
                 // register the university to be used for university_create
                 $uni_name;
                 $sql = "insert into university (uni_name) values ('$uni_name')";
                  if ($res = mysqli_query($db,$sql)) {
                      $uni_id = mysqli_insert_id($db); // Get the ID of the newly inserted university
                      echo "<br>University registered successfully with ID: " . $uni_id;
                        $sql = "insert into users (uni_id) values($'uni_id')";
                        if ($res = mysqli_query($db,$sql)) {
                            session_start();
                            $u_id;
                            $sql = "select * from users where u_id=$u_id";
                            if($res = mysqli_query($db,$sql)) {
                              if($row = mysqli_fetch_array($res)) {
                                  $last_inserted_user = $row;
                                  $_SESSION['u_id'] = $u_id;
                                }
                            }
                      //header("location: welcome.php?u_id=$u_id ");
                    }
                 } else {
                  echo "Error adding university: " . mysqli_error($db);
                 }

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
    echo "
    <input type='radio' id='userSelect1' name='register'  value='Yes' />
    <label>Yes </label><input type='text' id='university' name='uni_name'>
    <input type='radio' id='userSelect2' name='register'  value='No' />
    <label>No </label>
    <select data-label='Available Universities'>
    <option value=''>-- Select University -- </option>
    ";
    // List out the universities
    $sql = "select uni_id, uni_name from university";
    if($res = mysqli_query($db,$sql)) {
       while($row = mysqli_fetch_array($res)) {
        $uni_id = $row['uni_id'];
        $uni_name = $row['uni_name'];
        echo "<option value=$uni_id>$uni_name</option>";
       }
        
        echo "  
        </select>
        </div>
        <input type = 'submit' value = ' Register '/><br />
        <input type = 'hidden' name = 'university' value = 'uni_name' />
        ";
      
    }
?>
</form>
</html>
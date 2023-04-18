<?php
include('config.php');
?>

<?php
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $uni_name = mysqli_real_escape_string($db,$_POST['uni_name']);
    $info = mysqli_real_escape_string($db,$_POST['info']);

     // Create University and SuperAdmin, when there's no uni_id attached
     if ($uni_name == null) {
        $error = "University name is missing";
        } else {
        $sa_id;
        $u_id;
        $sql = "insert into SuperAdmin(u_id) values ($u_id)"; // needs to pull in the u_id from create_user
        if($res = mysqli_query($db,$sql)) {
            // Get the ID of the newly inserted superadmin
            $sa_id = mysqli_insert_id($db);
            // Insert the university
            $sql = "insert into University(uni_name, info, sa_id) values ('$uni_name', '$info', $sa_id) ";
            $uni_id;
              if($res = mysqli_query($db,$sql)) {
                if($row = mysqli_fetch_array($res)) {
                  $uni_id = $row[0];
                  $sa_id = $row[3];
                }
            }
        }
    }
}   
?>

<form action="university_create.php" method = "post">
<h2>Enter in the following to register your university</h2>
<label for="uni_name">University (Required): </label>
  <input type="text" name="uni_name" id="uni_name" minlength="1" maxlength="30" required><br>
<label for="info">Info (Optional): </label>
  <input type="text" name="info" id="info" ><br>
<input type = "submit" value = " Register "/><br />
</form>
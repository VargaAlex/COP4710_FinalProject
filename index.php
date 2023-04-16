<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$u_idErr = "";
$u_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["u_id"])) {
    $u_idErr = "User ID is required";
  } else {
    $u_id = test_input($_POST["u_id"]);
    // check if u_id only contains letters and whitespace
    if (!preg_match("/^[0123456789]*$/",$u_id)) {
      $u_idErr = "Only numbers allowed";
    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>COP4710 Final Project</h2>
<form method="post" action="welcome.php">  
  User ID: <input type="text" name="u_id" value="<?php echo $u_id;?>">
  <input type="hidden" name="u_idErr" value="<?php echo $u_idErr ?>">
  <span class="error"><?php echo $u_idErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Log In">  
</form>
<br>
<form method="post" action="new_user.php">
	<input type="submit" name="create" value="New User">
</form>

</body>
</html>
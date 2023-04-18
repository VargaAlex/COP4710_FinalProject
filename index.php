<?php 
	// File Written by Alex Varga
?>

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
	include('config.php');
	session_start();
	$error = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$user = mysqli_real_escape_string($db,$_POST['u_id']);
		$pass = mysqli_real_escape_string($db,$_POST['password']); 
		
		$sql = "SELECT u_id FROM Users WHERE u_id = $user and pass = '$pass' ";
		if($res = mysqli_query($db,$sql)) {
			
			$count = mysqli_num_rows($res);
			
			if($count) {
				if($row = mysqli_fetch_array($res)) {
					$_SESSION['u_id'] = $row[0];
					header("location: welcome.php");
				}
			}
			else {
				$error = "Your User ID or Password is invalid.";
			}
		}
		else {
			$error = "Your User ID or Password is invalid.";
		}
	}
?>



<h2>COP4710 Final Project</h2>
<?php echo $error; ?> <br /><br />
<form action = "" method = "post">
<label>User ID  :</label><input type = "text" name = "u_id" /><br /><br />
<label>Password  :</label><input type = "password" name = "password" /><br/><br />
<input type = "submit" value = " Submit "/><br />
<footer>New User?<a href="user_create.php">Register here</a></footer>
</form>



</body>
</html>
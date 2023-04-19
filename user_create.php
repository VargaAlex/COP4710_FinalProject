<?php 
	// File Written by Alex Varga
?>

<?php
	include('config.php');
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
	
	$error = "";
	$name = null;
	$password = null;
	$uni_id = null;
	if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $uni_id;
		if(isset($_POST['name'])) $name = mysqli_real_escape_string($db,$_POST['name']);
		if(isset($_POST['password'])) $password = mysqli_real_escape_string($db,$_POST['password']); 
		if(isset($_POST['uniSelect'])) $uni_id = mysqli_real_escape_string($db,$_POST['uniSelect']);
		if($name == null) {
			$error = "Please enter your name.";
		}
		else if($password == null) {
			$error = "Please enter a password for your account.";
		}
		else if($uni_id == null) {
			$error = "Please select a university, if yours is not available please select Create New University to create one.";
		}
		else {
			$sql = "insert into users(name, pass, uni_id) values('$name', '$password', $uni_id)";
			if($res = mysqli_query($db,$sql)) {
				$u_id;
				$sql = "select last_insert_id() ";
				if($res = mysqli_query($db,$sql)) {
					if($row = mysqli_fetch_array($res)) {
						$u_id = $row[0];
						session_start();
						$_SESSION['u_id'] = $u_id;
						if($uni_id > 0) {
							header("Location: welcome.php");
						}
						else {
							header("Location: university_create.php");
						}
						die();
					}
				}
			}
			
		}
	}
?>

<h2>Create User</h2>
<?php echo $error; ?> <br /><br />
<form action = "" method = "post">
<label>Name  :</label><input type = "text" name = "name" /><br /><br />
<label>Password  :</label><input type = "text" name = "password"/><br/><br />
University: 
<select name="uniSelect">
<option value="">Select...</option>

<?php
	$sql = "select uni_id, uni_name from university";
	if($res = mysqli_query($db,$sql)) {
		while($row = mysqli_fetch_array($res)) {
			$uni_id = $row[0];
			$uni_name = $row[1];
			echo "
			<option value=$uni_id>$uni_name</option>
			";
		}
	}
?>
<option value=-1>Create New University</option>
<input type = "submit" value = " Submit "/><br />
</form>



</body>
</html>
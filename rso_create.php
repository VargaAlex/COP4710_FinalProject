<?php
	include('session.php');
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
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$rso_name = mysqli_real_escape_string($db,$_POST['name']);
		$rso_info = mysqli_real_escape_string($db,$_POST['info']); 
		
		if($rso_name == null) {
			$error = "Your RSO needs a name.";
		}
		else if($rso_info == null) {
			$error = "Your RSO needs a description.";
		}
		else {
			$a_id;
			$uni_id;
			// Is user an admin already?
			$sql="select a_id from admins where u_id = $u_id ";
			if($res = mysqli_query($db,$sql)) {
				if(!$row = mysqli_fetch_array($res)) {
					// no? make them one
					$sql = "insert into admins(u_id) values($u_id)";
					if($res = mysqli_query($db,$sql)) {
					}
				}
				// They're either already an admin or we just made them one, get that id
				$sql = "select a_id from admins where u_id = $u_id ";
				if($res = mysqli_query($db,$sql)) {
					if($row = mysqli_fetch_array($res)) {
						$a_id = $row[0];
					}
				}
			}
			//Get uni_id
			$sql = "select uni_id from users where u_id = $u_id ";
			if($res = mysqli_query($db,$sql)) {
				if($row = mysqli_fetch_array($res)) {
					$uni_id = $row[0];
				}
			}
			// Create RSO
			
			$sql = "insert into RSO(name, a_id, uni_id, info) values ('$rso_name', $a_id, $uni_id, '$rso_info') ";
			if($res = mysqli_query($db,$sql)) {
				$sql = "select last_insert_id() ";
				$rso_id;
				if($res = mysqli_query($db,$sql)) {
					if($row = mysqli_fetch_array($res)) {
						$rso_id = $row[0];
					}
				}
				header("location: rso_join.php?rso_id=$rso_id ");
			}
		}
	}
?>



<h2>Create RSO</h2>
<?php echo $error; ?> <br /><br />
<form action = "" method = "post">
<label>RSO name  :</label><input type = "text" name = "name" /><br /><br />
<label>Description  :</label><input type = "text" cols="51" rows="5" style="width:510px; height:100px;" name = "info"/><br/><br />
<input type = "submit" value = " Submit "/><br />
</form>



</body>
</html>
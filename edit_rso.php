<?php
	include('session.php');
?>

<?php
	$rso_id = htmlspecialchars($_GET['rso_id']);
	if($rso_id == NULL) {
		header("Location: welcome.php");
		die();
	}
	// Get current RSO data
	$sql = "select name, info from RSO where rso_id = $rso_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$rso_name = $row[0];
			$rso_info = $row[1];
			echo "
			<h2> Edit RSO </h2>
			<h3>Current Info</h3>
			<b>RSO Name: </b>$rso_name<br />
			<b>RSO Info: </b>$rso_info<br />
			";
		}
	}
	$exit = 0;
	// Check that user is admin of this rso
	//Get admin id for rso
	$sql = "select a_id from RSO where rso_id = $rso_id";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$a_id = $row[0];
			// is user this admin?
			$sql = "select * from admins where a_id = $a_id and u_id = $u_id";
			if($res = mysqli_query($db,$sql)) {
				if($row = mysqli_fetch_array($res)) {
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$rso_name = mysqli_real_escape_string($db,$_POST['name']);
						$rso_info = mysqli_real_escape_string($db,$_POST['info']); 
						
						if($rso_name != NULL) {
							$sql = "update RSO set name = '$rso_name' where rso_id = $rso_id ";
							if($res = mysqli_query($db,$sql)) {
								$exit = 1;
							}
						}
						if($rso_info != NULL) {
							$sql = "update RSO set info = '$rso_info' where rso_id = $rso_id ";
							if($res = mysqli_query($db,$sql)) {
								$exit = 1;
							}
						}
						
						
					}
					if($exit) {
						header("Location: rso_details.php?rso_id=$rso_id");
						die();
					}
					echo "
					<h3>New Info</h3>
					
					<form action = \"\" method = \"post\">
					<label>RSO name  :</label><input type = \"text\" name = \"name\" /><br /><br />
					<label>Description  :</label><input type = \"text\" cols=\"51\" rows=\"5\" style=\"width:510px; height:100px;\" name = \"info\"/><br/><br />
					<input type = \"submit\" value = \" Submit \"/><br />
					</form>
					";
				}
				else {
					// User is not the admin of this RSO
					echo "Only the admin of this RSO may edit its details. You have reached this page by mistake. You can find the RSOs you are a part of <a href='welcome.php'>here</a>.";
				}
			}
		}
		else {
			// RSO does not have an admin, which means it does not exist.
			// This case is handled by rso_details
			header("Location: rso_details.php?rso_id=$rso_id ");
			die();
		}
	}
?>

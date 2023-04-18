<?php
	include('session.php');
?>

<h2>Event Details </h2>

<?php
	$e_name;
	$e_id = htmlspecialchars($_GET['e_id']);
	if($e_id == NULL) {
		header("location:event_list.php");
	}
	
	// Check if event exists, get its info
	$sql = "select * from events where e_id = $e_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$e_name = $row[1];
			$e_date = $row[2];
			$e_time = $row[3];
			$e_info = $row[4];
			$e_location = $row[5];
			$location_name;
			$sql = "select l_name from location where l_id = $e_location";
			if($res = mysqli_query($db,$sql)) {
				if($row = mysqli_fetch_array($res)) {
						$location_name = $row[0];
				}
			}
			echo "<h3>$e_name</h3>On $e_date at $e_time o'clock.<br/>$e_info<br/>Location: <a href='location_detial.php?l_id=$e_location'>$location_name</a><br />";
		}
	}
?>
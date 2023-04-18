<?php 
	// File Written by Alex Varga
?>

<?php
	include('session.php');
?>
<h2>Create Private Event</h2>
<?php
	$error;
	//$_SERVER["REQUEST_METHOD"] = "POST";
	$is_admin=0;
	$is_superadmin=0;
	$rsoList = array();
	
	// determine if user is an admin and their a_id if so
	$sql = "select a_id from admins where u_id = $u_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$is_admin = $row[0];
		}
	}
	
	// determine if user is a superadmin and their sa_id if so
	$sql = "select sa_id from superadmins where u_id = $u_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$is_superadmin = $row[0];
		}
	}
	
	// if user is admin, determine what RSOs they're admin of
	if($is_admin){
		$sql = "select rso_id from rso where a_id = $is_admin";
		if($res = mysqli_query($db,$sql)) {
			while($row = mysqli_fetch_array($res)) {
				$rso_list[] = $row[0];
			}
		}
	}
	
	if($is_admin or $is_superadmin) {
		$error = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$event_name = mysqli_real_escape_string($db,$_POST['name']);
			$event_info = mysqli_real_escape_string($db,$_POST['info']);
			$event_date = mysqli_real_escape_string($db,$_POST['date']);
			$event_time = mysqli_real_escape_string($db,$_POST['time']);
			$event_location = mysqli_real_escape_string($db,$_POST['locationSelect']);
			
			
			
			// Change time into int
			$event_time = intval(substr($event_time, 0, 2));
			
			// Change location into int
			$event_location = intval($event_location);
			
			// Change is superadmin to sa_id of university
			if(!$is_superadmin) {
				$sql = "select uni_id from user where u_id = $u_id";
				if($res = mysqli_query($db,$sql)) {
					if($row = mysqli_fetch_array($res)) {
						$uni_id = $row[0];
						$sql = "select sa_id from superadmins where uni_id = $uni_id";
						if($res = mysqli_query($db,$sql)) {
							if($row = mysqli_fetch_array($res)) {
								$is_superadmin = $row[0];
							}
						}
					}
				}
			}
			
			// Detect any other events at this time and place
			$sql = "select * from events where time = $event_time and date = '$event_date' and l_id = $event_location";
			if($res = mysqli_query($db,$sql)) {
				if($row = mysqli_fetch_array($res)) {
					echo "There is already an event at this time and place, please choose another.";
				}
				else {
					// Input Event
					$sql = "insert into events(e_name, date, time, info, l_id) values('$event_name', '$event_date', $event_time, '$event_info', $event_location)";
					if($res = mysqli_query($db,$sql)) {
						$sql = "select last_insert_id() ";
						if($res = mysqli_query($db,$sql)) {
							if($row = mysqli_fetch_array($res)) {
								$e_id = $row[0];
								if(!$is_admin) $is_admin = null;
								$sql = "insert into private_events(e_id, a_id, sa_id) values($e_id, $is_admin, $is_superadmin) ";
								if($res = mysqli_query($db,$sql)) {
									header("Location:event_details.php?e_id=$e_id");
								}
								else echo "Failed to insert new private event.";
							}
						}
						else echo "Failed to find last entry";
					}
					else echo "Entry Failed";
				}
			}
		}
	}
	else {
		header("Location:event_create.php");
		die();
	}

?>


<form action = '' method = 'post'>
<label>Event name  :</label><input type = 'text' name = 'name' /><br /><br />
<label>Description  :</label><input type = 'text' cols='51' rows='5' style='width:510px; height:100px;' name = 'info'/><br/><br />
<label>Date  :</label><input type = 'date' name='date' /><br/><br />
<label>Time  :</label><input type = 'time' name='time' step = 3600 min = '0:00' max = '23:00' /><br/><br />
<p>
Location: 
<select name="locationSelect">
<option value="">Select...</option>

<?php
	$sql = "select l_id, l_name from location";
	if($res = mysqli_query($db,$sql)) {
		while($row = mysqli_fetch_array($res)) {
			$l_id = $row[0];
			$l_name = $row[1];
			echo "
			<option value=$l_id>$l_name</option>
			";
		}
	}
?>

</select>
</p>
<input type = "hidden" name = "location" value = "locationSelect" />
<input type = "hidden" name = "e_type" value = $e_type />
<input type = "submit" value = " Submit "/><br />

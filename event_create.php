<?php
	include('session.php');
?>
<h2>Create Event</h2>
<?php
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
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['e_type'])) {
		$e_type = $_POST['e_type'];
		header("Location:event_create_$e_type");
		die();
	}

	// Create event type selection form, admins have access to all three types
	echo "<form action = '' method = 'post'>
		<fieldset>
			<legend> What type of event is this? </legend>
			<div>
			";
	if($is_admin or $is_superadmin) {
		echo "<input type='radio' id='e_type1' name='e_type' value='public' />
			<label for='e_type1'>Public Event</label>
			
			<input type='radio' id='e_type2' name='e_type' value='private' />
			<label for='e_type2'>Private Event</label>
			
			";
			
		if ($is_admin) {
			echo "<input type='radio' id='e_type3' name='e_type' value='rso' />
				<label for='e_type3'>RSO Event</label>
				";
		}
		echo "</div>
				<div>
					<button type='submit'>Submit</button>
				</div>
			</fieldset>
		</form>";
	}
	else {
		echo "If you would like an event created, please contact an admin or superadmin to create one for you. Only admins and superadmins may create events. Thank you.";
	}

?>

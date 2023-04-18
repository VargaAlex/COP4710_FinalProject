<?php
	include('session.php');
?>
<a href = 'rso_create.php'><b>Create an RSO</b></a>
<h2> RSO Groups </h2>

<?php
	$uni_id;
	// Get uni_id
	$sql = "select uni_id from users where u_id = $u_id";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$uni_id = $row[0];
		}
	}
	
	$sql = "select * from RSO where uni_id = $uni_id";
	if($res = mysqli_query($db,$sql)) {
		while($row = mysqli_fetch_array($res)) {
			$rso_id = $row[0];
			$a_id = $row[1];
			$rso_name = $row[3];
			$active = $row[4];
			if ($active > 0) {
				$active = 'Active';
			}
			else {
				$active = 'Inactive';
			}
			$admin_name;
			$members;
			// Locate admin name
			$sql = "select u_id from admins where a_id = $a_id ";
			if($res_a = mysqli_query($db,$sql)) {
				if($a_u_id = mysqli_fetch_array($res_a)) {
					$sql = "select name from users where u_id = $a_u_id[0]";
					if($res_a = mysqli_query($db,$sql)) {
						if($a_u_name = mysqli_fetch_array($res_a)) {
							$admin_name = $a_u_name[0];
						}
					}
				}
			}
			// locate number of members
			$sql = "select count(distinct u_id) as numMembers from Joins where rso_id = $rso_id ";
			if($res_a = mysqli_query($db,$sql)) {
				if($a_count = mysqli_fetch_array($res_a)) {
					$members = $a_count[0];
				}
			}
			echo "<b><a href='rso_details.php?rso_id=$rso_id'>$rso_name</a></b> Status: $active<br />
				Admin: $admin_name<br />Members: $members <br /><br />" ;
		}
	}
?>
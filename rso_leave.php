<?php
	include('session.php');
?>

<?php
	$rso_id = htmlspecialchars($_GET['rso_id']);
	
	
	// Delete the Join relationship
	$sql = "delete from joins where u_id = $u_id and rso_id = $rso_id";
	if($res = mysqli_query($db,$sql)) {
		
	}
	
	// Promote Oldest member of the RSO to admin, delete rso and all of its events if no one is left
	
	
	$sql = "select count(distinct u_id) as member from Joins where rso_id = $rso_id";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			if($row[0] < 1){
				$sql = "delete from RSO where rso_id = $rso_id";
				if($res = mysqli_query($db,$sql)) {
					$sql = "select e_id from RSO_events where rso_id = $rso_id";
					if($res = mysqli_query($db,$sql)) {
						while($row = mysqli_fetch_array($res)) {
							$e_id = $row[0];
							include('event_delete.php');
						}
					}
				}
			}
			else {
				if($row[0] < 4) {
					$sql = "update RSO set active = 0 where rso_id = $rso_id ";
					if($res = mysqli_query($db,$sql)) {	
					}
					
					
				}
				
				// If current user was admin of this rso, assign a new admin
				$sql = "select u_id, min(since) from joins where rso_id = $rso_id";
				if($res = mysqli_query($db,$sql)) {
					if($row = mysqli_fetch_array($res)) {
						$new_u_id = $row[0];
						$new_a_id;
						// Checks if new user is already an admin
						$sql = "select count(u_id) as adminquery from admins where u_id = $new_u_id";
						if($res = mysqli_query($db,$sql)) {
							if($row = mysqli_fetch_array($res)) {
								if($row[0] > 0) {
									$sql = "select a_id from admins where u_id = $new_u_id";
									if($res = mysqli_query($db,$sql)) {
										if($row = mysqli_fetch_array($res)) {
											$new_a_id = $row[0];
										}
									}
								}
								else {
									// creates new admin position
									$sql = "insert admins(u_id) values($new_u_id)";
									if($res = mysqli_query($db,$sql)) { 
										$sql = "select a_id from admins where u_id = $new_u_id ";
										if($res = mysqli_query($db,$sql)) {
											if($row = mysqli_fetch_array($res)) {
												$new_a_id = $row[0];
											}
										}
									}
								}
							}
						}
						
						// assign new admin to rso
						$sql = "update rso set a_id = $new_a_id where rso_id = $rso_id";
						if($res = mysqli_query($db,$sql)) {
							
						}
						// Is current user still an admin of any RSOs?
						$sql = "select a_id from admins where u_id = $u_id";
						if($res = mysqli_query($db,$sql)) {
							if($row = mysqli_fetch_array($res)) {
								$sql = "select count(*) as remaining from RSO where a_id = $row[0]";
								if($res = mysqli_query($db,$sql)) {
									if($row = mysqli_fetch_array($res)) {
										if($row[0] < 1) {
											$sql = "delete from admins where u_id = $u_id";
											if($res = mysqli_query($db,$sql)) {
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	header("location: rso_list.php");
	die();
?>

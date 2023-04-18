<?php 
	// File Written by Alex Varga
?>

<?php
	include('session.php');
?>

<?php
	$rso_id = htmlspecialchars($_GET['rso_id']);
	
	$sql = "insert into Joins(u_id, rso_id, since) values ($u_id, $rso_id, sysdate())";
	if($res = mysqli_query($db,$sql)) {
		//check if RSO is not active
		$sql = "select count(distinct rso_id) as check from RSO where rso_id = $rso_id and active = 0 ";
		if($res = mysqli_query($db,$sql)) {
			if($row = mysqli_fetch_array($res)) {
				if($row[0]) {
					//Is not active
					$sql = "select count(distinct u_id) as nummembers from Joins where rso_id = $rso_id ";
					if($res = mysqli_query($db,$sql)) {
						if($row = mysqli_fetch_array($res)) {
							if($row[0] > 3) {
								$sql = "update RSO set active = 1 where rso_id = $rso_id ";
								if($res = mysqli_query($db,$sql)){
								}
							}
						}
					}
				}
			}
		}
	}
	
	header("location: rso_details.php?rso_id=$rso_id ");
	die();
?>
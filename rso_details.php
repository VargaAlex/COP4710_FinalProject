<!DOCTYPE html>

<?php
	include('session.php');
?>

<?php
	$rso_name;
	$rso_id = htmlspecialchars($_GET['rso_id']);
	if($rso_id == NULL) {
		header("location:rso_list.php");
	}
	// Check if RSO exists, get its name
	$sql = "select name, info from RSO where rso_id = $rso_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$rso_name = $row[0];
			$desc = $row[1];
			echo "<h2>RSO Details:</h2><h3>".$rso_name."</h3>$desc";
		}
		else {
			header("location:rso_list.php");
			die();
		}
	}
	
	//If user is admin, present edit link
	//Get admin id for rso
	$sql = "select a_id from RSO where rso_id = $rso_id";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$a_id = $row[0];
			// is user this admin?
			$sql = "select * from admins where a_id = $a_id and u_id = $u_id";
			if($res = mysqli_query($db,$sql)) {
				if($row = mysqli_fetch_array($res)) {
					echo "<br /><a href='rso_edit.php?rso_id=$rso_id'>Edit Details</a>";
				}
			}
		}
	}
	
	$sql = "select count(distinct u_id) as numMembers from Joins where rso_id = $rso_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			echo "<h4>Members: $row[0]</h4>";
		}
	}
	
	$sql = "select count(distinct u_id) as member from Joins where rso_id = $rso_id and u_id = $u_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$member = $row[0];
			
			if ($member > 0) {
				// If user is a member, print members of this RSO
				
				
				$sql2 = "select distinct u_id from joins where rso_id = $rso_id ";
				if($res2 = mysqli_query($db,$sql2)) {
					while($row2 = mysqli_fetch_array($res2)) {
						$sql3 = "select name from users where u_id = $row2[0] ";
						if($res3 = mysqli_query($db,$sql3)) {
							while($row3 = mysqli_fetch_array($res3)) {
								echo $row3[0]."<br />";
							}
						}
					}
				}
				// Leave Link
				echo "<br /><br /><a href='rso_leave.php?rso_id=$rso_id'>Leave $rso_name</a>";
			}
			else {
				// Join Link
				echo "<a href='rso_join.php?rso_id=$rso_id'>Join $rso_name</a>";
			}
		}
	}
	
	
?>
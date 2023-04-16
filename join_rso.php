<?php
	include('session.php');
?>

<?php
	$rso_id = htmlspecialchars($_GET['rso_id']);
	
	$sql = "insert into Joins(u_id, rso_id) values ($u_id, $rso_id)";
	if($res = mysqli_query($db,$sql)) {
		
	}
	
	header("location: rso_details.php?rso_id=$rso_id ");
	die();
?>
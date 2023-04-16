<?php
	include('session.php');
?>

<?php
	$rso_id = htmlspecialchars($_GET['rso_id']);
	
	$sql = "delete from joins where u_id = $u_id and rso_id = $rso_id";
	if($res = mysqli_query($db,$sql)) {
		
	}
	
	header("location: rso_details.php?rso_id=$rso_id ");
	die();
?>
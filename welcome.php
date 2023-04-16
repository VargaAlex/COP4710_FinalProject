<!DOCTYPE html>

<?php
	
	include('session.php');
?>

<html>
<body>


<?php

// Welcome <user's name>
$sql = "select name from users where u_id = $u_id ";
if($res = mysqli_query($db,$sql)) {
	if($row = mysqli_fetch_array($res)) {
		$name = $row[0];
		echo "Welcome $name<br />";
	}
}
?>

<?php
// Display user's university, if any.
$sql = "select uni_id from users where u_id = $u_id ";
if($res = mysqli_query($db,$sql)) {
	if($row = mysqli_fetch_array($res)) {
		$uni_id = $row[0];
		$sql = "select uni_name from university where uni_id = $uni_id ";
		if($res = mysqli_query($db,$sql)) {
			if($row = mysqli_fetch_array($res)) {
				if($row[0] != NULL) {
					$uni_name = $row[0];
					echo "Your University: $uni_name<br /><br />";
				}
			}
		}
	}
}
?>

<?php
// Display user's RSOs, if any 
$sql = "select rso_id from Joins where u_id = $u_id ";
if($res = mysqli_query($db,$sql)) {
	echo "Your RSOs: <br />";
	while($row = mysqli_fetch_array($res)) {
		if ($row[0] != NULL)  {
			$sql2 = "select name from RSO where rso_id = $row[0]";
			if($res2 = mysqli_query($db,$sql2)) {
				while($row2 = mysqli_fetch_array($res2)) {
					echo "<a href='rso_details.php?rso_id=$row[0]'>" . $row2[0]."</a>, ";
				}
			}
			$sql3 = "select count(distinct u_id) as numMembers from Joins where rso_id = $row[0] ";
			if($res3 = mysqli_query($db,$sql3)) {
				while($row3 = mysqli_fetch_array($res3)) {
					echo "# of members: " . $row3[0] . "<br />";
				}
			}
		}
	}
}
?>
<br>
<a href="rso_list.php">Join a new RSO</a>
<?php

?>

</body>
</html>

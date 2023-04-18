<?php
	include('session.php');
	$pub_pg;
	$pri_pg;
	$rso_pg;
	
	if(isset($_GET['pub_pg'])) {
		$pub_pg = (int)htmlspecialchars($_GET['pub_pg']);
		if($pub_pg < 1) $pub_pg = 1;
	} else {
		$pub_pg = 1;
	}
		
	if(isset($_GET['pri_pg'])) {
		$pri_pg = (int)htmlspecialchars($_GET['pri_pg']);
	} else {
		$pri_pg = 1;
	}
	
	if(isset($_GET['rso_pg'])) {
		$rso_pg = (int)htmlspecialchars($_GET['rso_pg']);
	} else {
		$rso_pg = 1;
	}
	
	$pub_avail = 0;
	$pri_avail = 0;
	$rso_avail = 0;
	
	$sql = "select count(distinct e_id) as events from public_events";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$pub_avail = $row[0];
		}
	}
	
	
	$uni_id;
	$sql = "select uni_id from users where u_id = $u_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$uni_id = $row[0];
		}
	}
	$sql = "select sa_id from university where uni_id = $uni_id";
	$sa_id;
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$sa_id = $row[0];
		}
	}
	
	$sql = "select count(distinct e_id) as events from private_events where sa_id = $sa_id ";
	if($res = mysqli_query($db,$sql)) {
		if($row = mysqli_fetch_array($res)) {
			$pri_avail = $row[0];
		}
	}
	
	$sql = "select rso_id from Joins where u_id = $u_id ";
	if($res = mysqli_query($db,$sql)) {
		while($row = mysqli_fetch_array($res)) {
			if ($row[0] != NULL)  {
				$sql2 = "select count(distinct e_id) as events from RSO_events where rso_id = $row[0]";
				if($res2 = mysqli_query($db,$sql2)) {
					if($row2 = mysqli_fetch_array($res2)) {
						$rso_avail += $row2[0];
					}
				}
			}
		}
	}
	
	$pub_pages = CEIL($pub_avail/5);
	$pri_pages = CEIL($pri_avail/5);
	$rso_pages = CEIL($rso_avail/5);
	
	$pub_pg_l = MAX(1, $pub_pg - 1);
	$pri_pg_l = MAX(1, $pri_pg - 1);
	$rso_pg_l = MAX(1, $rso_pg - 1);
	$pub_pg_r = MIN($pub_pg + 1, $pub_pages);
	$pri_pg_r = MIN($pri_pg + 1, $pri_pages);
	$rso_pg_r = MIN($rso_pg + 1, $rso_pages);
	
	// Print Public Events
	echo "<h3>Public Events </h3>";
	
	$pub_events;
	$sql = "select distinct e_id from public_events";
	if($res = mysqli_query($db,$sql)) {
		$k = 0;
		while($pub_events = mysqli_fetch_array($res)) {
			if ($k >= 5*($pub_pg-1) and $k < 5*($pub_pg) and $k < $pub_avail) {
				$event_details;
				$sql = "select * from events where e_id = $pub_events[0] ";
				if($res = mysqli_query($db,$sql)) {
					while($row = mysqli_fetch_array($res)) {
						echo "<br />";
						echo $row[1]."<br />";
						echo $row[2]."<br />";
						echo $row[3]."<br />";
						$l_id = $row[4];
						$sql = "select * from location where l_id = $l_id";
						if($res_l = mysqli_query($db,$sql)) {
							while($row = mysqli_fetch_array($res_l)) {
								echo "<a href='show_location.php?l_id=$row[0]'>$row[1]</a><br />";
								echo $row[2]."<br />";
							}
						}
						echo "<br />";
					}
				}
			}
		}
	}
	
	echo "<h5>Page $pub_pg of $pub_pages 
	<a href = 'event_list.php?pub_pg=$pub_pg_l,pri_pg=$pri_pg,rso_pg=$rso_pg'>&lt&ltPrevious</a> 
	<a href = 'event_list.php?pub_pg=$pub_pg_r,pri_pg=$pri_pg,rso_pg=$rso_pg'>Next&gt&gt</a> 
	<h5/>";
	
	echo "<h3>Private University Events </h3>";
	
	$pri_events;
	$sql = "select distinct e_id from private_events where sa_id = $sa_id ";
	if($res = mysqli_query($db,$sql)) {
		$k = 0;
		while($pri_events = mysqli_fetch_array($res)) {
			if ($k >= 5*($pri_pg-1) and $k < 5*($pri_pg) and $k < $pri_avail) {
				$event_details;
				$sql = "select * from events where e_id = $pri_events[0] ";
				if($res = mysqli_query($db,$sql)) {
					while($row = mysqli_fetch_array($res)) {
						echo "<br />";
						echo $row[1]."<br />";
						echo $row[2]."<br />";
						echo $row[3]."<br />";
						$l_id = $row[4];
						$sql = "select * from location where l_id = $l_id";
						if($res_l = mysqli_query($db,$sql)) {
							while($row = mysqli_fetch_array($res_l)) {
								echo "<a href='show_location.php?l_id=$row[0]'>$row[1]</a><br />";
								echo $row[2]."<br />";
							}
						}
						echo "<br />";
					}
				}
			}
		}
	}
	
	
	echo "<h5>Page $pri_pg of $pri_pages 
	<a href = 'event_list.php?pri_pg=$pub_pg,pri_pg=$pri_pg_l,rso_pg=$rso_pg'>&lt&ltPrevious</a> 
	<a href = 'event_list.php?pri_pg=$pub_pg,pri_pg=$pri_pg_r,rso_pg=$rso_pg'>Next&gt&gt</a> 
	<h5/>";
	
	//RSO events
	echo "<h3>RSO Events </h3>";
	
	$rso_events;
	
	$sql = "select rso_id from Joins where u_id = $u_id ";
	if($res = mysqli_query($db,$sql)) {
		while($row = mysqli_fetch_array($res)) {
			if ($row[0] != NULL)  {
				$sql2 = "select distinct e_id from RSO_events where rso_id = $row[0]";
				if($res2 = mysqli_query($db,$sql2)) {
					$k = 0;
					while($rso_events = mysqli_fetch_array($res2)) {
						if ($k >= 5*($rso_pg-1) and $k < 5*($rso_pg) and $k < $rso_avail) {
							$event_details;
							$sql3 = "select * from events where e_id = $rso_events[0] ";
							if($res3 = mysqli_query($db,$sql3)) {
								while($row3 = mysqli_fetch_array($res3)) {
									echo "<br />";
									$sql5 = "select name from RSO where rso_id = $row[0]";
									if($res5 = mysqli_query($db,$sql5)) {
										if ($rso_name = mysqli_fetch_array($res5)) {
											echo $rso_name[0]."<br />";
										}
									}
									echo $row3[1]."<br />";
									echo $row3[2]."<br />";
									echo $row3[3]."<br />";
									$l_id = $row3[4];
									$sql = "select * from location where l_id = $l_id";
									if($res_4 = mysqli_query($db,$sql)) {
										while($row4 = mysqli_fetch_array($res_4)) {
											echo "<a href='show_location.php?l_id=$row4[0]'>$row4[1]</a><br />";
											echo $row4[2]."<br />";
										}
									}
									echo "<br />";
								}
							}
						}
					}
				}
			}
		}
	}
	
	echo "<h5>Page $pri_pg of $pri_pages 
	<a href = 'event_list.php?pri_pg=$pub_pg,pri_pg=$pri_pg_l,rso_pg=$rso_pg'>&lt&ltPrevious</a> 
	<a href = 'event_list.php?pri_pg=$pub_pg,pri_pg=$pri_pg_r,rso_pg=$rso_pg'>Next&gt&gt</a> 
	<h5/>";
	
?>



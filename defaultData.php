<?php
	$s = array();
	
	$s[0] = "insert into users(pass, name, uni_id) values('password', 'Alex Varga', 1);";
	
	$s[1] = "insert into superadmins(u_id) values(1);";
	
	$s[2] = "insert into university(uni_name, sa_id) values ('UCF', 1);";
	
	$s[3] = "insert into admins(u_id) values(1);";
	
	$s[4] = "insert into RSO(name, a_id) values ('DnD Club', 1), ('DB with Vu', 1), ('Vu Worship Group', 1);";
	
	$s[5] = "insert into Joins(u_id, rso_id) values (1,1), (1,2), (1,3);";
	
	$s[6] = "insert into users(pass, name, uni_id) values('password', 'Big Jeff', 1);";
	
	$s[7] = "insert into Joins(u_id, rso_id) values (2,1);";
?>
<?php 
	// File Written by Alex Varga
?>

<?php
	$s = array();
	
	$s[0] = "insert into users(pass, name, uni_id) values('password', 'Alex Varga', 1);";
	
	$s[1] = "insert into superadmins(u_id) values(1);";
	
	$s[2] = "insert into university(uni_name, sa_id) values ('UCF', 1);";
	
	$s[3] = "insert into admins(u_id) values(1);";
	
	$s[4] = "insert into RSO(name, a_id, uni_id, active, info) values ('DnD Club', 1, 1, 0, 'Rolling dice and going on adventure. We play dungeons and dragons! DnD is a tabletop RPG where you go on adventures, similar to skyrim or lord of the rings, but anything is possible and you have a hand in the story.'), ('DB with Vu', 1, 1, 0, 'COP4710 with Khahn Vu.'), ('Vu Fan Club', 1, 1, 0, 'We love Vu. Please give me an A.');";
	
	$s[5] = "insert into Joins(u_id, rso_id, since) values (1,1, sysdate()), (1,2, sysdate()), (1,3, sysdate());";
	
	$s[6] = "insert into users(pass, name, uni_id) values('password', 'Big Jeff', 1);";
	
	$s[7] = "insert into Joins(u_id, rso_id, since) values (2,1, 2147383445);";
	
	$s[8] = "insert into location(l_name, address, info) values ('RWC', '4000 Central Florida Blvd. Orlando, Florida 32816', 'UCF Main Gym, has pool, rock climbing, track, and raquet ball in addition to standard gym features.') ";
	
	$s[9] = "insert into events (e_name, time, info, l_id) values ('Knight Climb', 1700, 'An open climbing event at the UCF RWC\'s climbing tower.', 1) ";
	
	$s[10] = "insert into private_events(e_id, a_id, sa_id) values (1, 1, 1)";
	
	$s[11] = "insert into events (e_name, time, info, l_id) values ('Open Knight Climb', 1800, 'An open climbing event at the UCF RWC\'s climbing tower.', 1) ";
	
	$s[12] = "insert into public_events(e_id, a_id, sa_id) values (2, 1, 1)";
	
	$s[13] = "insert into events (e_name, time, info, l_id) values ('Campaign Start', 600, 'The start of the DnD club\'s Hoard of the Dragon Queen campaign. Bring level 3 characters and prepare to save a town under seige from a dragon!', 1)";
	
	$s[14] = "insert into rso_events(e_id, rso_id) values(3, 1)";
?>
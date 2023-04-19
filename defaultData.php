<?php 
	// File Written by Alex Varga
?>

<?php
	$s = array();
	// Insert 20 users
	$s[0] = "insert into users(pass, name, uni_id) values('password', 'Alex Varga', 1)";
	$s[1] = "insert into users(pass, name, uni_id) values('password', 'Jimmy Smith', 1)";
	$s[2] = "insert into users(pass, name, uni_id) values('password', 'Carolina North', 1)";
	$s[3] = "insert into users(pass, name, uni_id) values('password', 'Big Jeff', 1)";
	$s[4] = "insert into users(pass, name, uni_id) values('password', 'Yelena Fitzgerald', 1)";
	$s[5] = "insert into users(pass, name, uni_id) values('password', 'Small Jeff', 1)";
	$s[6] = "insert into users(pass, name, uni_id) values('password', 'Knitro', 1)";
	$s[7] = "insert into users(pass, name, uni_id) values('password', 'John Johnson', 1)";
	$s[8] = "insert into users(pass, name, uni_id) values('password', 'Mr. President', 1)";
	$s[9] = "insert into users(pass, name, uni_id) values('password', 'Harold', 1)";
	$s[10] = "insert into users(pass, name, uni_id) values('password', 'NPC#1', 1)";
	$s[11] = "insert into users(pass, name, uni_id) values('password', 'NPC#2', 1)";
	$s[12] = "insert into users(pass, name, uni_id) values('password', 'NPC#3', 1)";
	$s[13] = "insert into users(pass, name, uni_id) values('password', 'NPC#4', 1)";
	$s[14] = "insert into users(pass, name, uni_id) values('password', 'Helen Greene', 1)";
	$s[15] = "insert into users(pass, name, uni_id) values('password', 'Jacob Varga', 2)";
	$s[16] = "insert into users(pass, name, uni_id) values('password', 'Ryan Smoke', 2)";
	$s[17] = "insert into users(pass, name, uni_id) values('password', 'Senji O.', 2)";
	$s[18] = "insert into users(pass, name, uni_id) values('password', 'Gregory Valor', 2)";
	$s[19] = "insert into users(pass, name, uni_id) values('password', 'Genshin Impact', 2)";
	
	// Create 2 Universities
	$s[20] = "insert into university(uni_name, info, sa_id) values('UCF', 'University of Central Florida', 1)";
	$s[21] = "insert into university(uni_name, info, sa_id) values('FSU', 'Florida State University', 2)";
	$s[22] = "insert into superadmins(u_id) values (9)";
	$s[23] = "insert into superadmins(u_id) values (19)";
	
	// Create 3 RSOs
	$s[24] = "insert into RSO(a_id, uni_id, name, info, active) values(1, 1, 'D&D Club', 'UCF\'s Dungeons and Dragons club, founded 2023.', 1)";
	$s[25] = "insert into RSO(a_id, uni_id, name, info) values(7, 1, 'Databases', 'COP4710, spring 2023, with Khanh Vu.')";
	$s[26] = "insert into RSO(a_id, uni_id, name, info) values(1, 1, 'Climbing Club', 'UCF\'s Climbing club, founded 2023. We have meetings every Tuesday and Thursday at 8 AM! Come by to see what\'s up!')";
	
	// Joins for the clubs
	$s[27] = "insert into Joins(u_id, rso_id, since) values(1,1, 1112)";
	$s[28] = "insert into Joins(u_id, rso_id, since) values(11,1, 1113)";
	$s[29] = "insert into Joins(u_id, rso_id, since) values(12,1, 1114)";
	$s[30] = "insert into Joins(u_id, rso_id, since) values(13,1, 1115)";
	$s[31] = "insert into Joins(u_id, rso_id, since) values(14,1, 1116)";
	$s[32] = "insert into Joins(u_id, rso_id, since) values(7,2, 1117)";
	$s[33] = "insert into Joins(u_id, rso_id, since) values(8,2, 1118)";
	$s[34] = "insert into Joins(u_id, rso_id, since) values(9,2, 1119)";
	$s[35] = "insert into Joins(u_id, rso_id, since) values(10,2, 11111)";
	$s[36] = "insert into Joins(u_id, rso_id, since) values(1,3, 11112)";
	
	// Create the Admins for the clubs
	$s[37] = "insert into admins(u_id) values(1)";
	$s[38] = "insert into admins(u_id) values(7)";
	
	// Create 3 Locations
	$s[39] = "insert into location(l_name, address, info) values ('RWC', '4000 Central Florida Blvd. Orlando, Florida 32816', 'UCF Main Gym, has pool, rock climbing, track, and raquet ball in addition to standard gym features.') ";
	$s[40] = "insert into location(l_name, address, info) values ('HS1 O119', 'Health Sciences Building', 'Near CB1 and the student union, right behind starbucks.' )";
	$s[41] = "insert into location(l_name, address, info) values ('Alex\'s House', 'This is where my address would go.', 'Red door, bring snacks to bribe the DM.')";
	
	// Create 10 events, 6 rso events, 3 public events, 1 private event
	$s[42] = "insert into events(e_name, date, time, info, l_id) values('Session 1', '2023-04-18', 19, 'Session 1 of our weekly Storm King\'s Thunder Adventure. Open to all members.', 3)";
	$s[43] = "insert into events(e_name, date, time, info, l_id) values('Session 2', '2023-04-25', 19, 'Session 2 of our weekly Storm King\'s Thunder Adventure. Open to all members.', 3)";
	$s[44] = "insert into events(e_name, date, time, info, l_id) values('Session 3', '2023-05-02', 19, 'Session 3 of our weekly Storm King\'s Thunder Adventure. Open to all members.', 3)";
	$s[45] = "insert into events(e_name, date, time, info, l_id) values('Session 4', '2023-05-09', 19, 'Session 4 of our weekly Storm King\'s Thunder Adventure. Open to all members.', 3)";
	$s[46] = "insert into events(e_name, date, time, info, l_id) values('Session 5', '2023-05-16', 19, 'Session 5 of our weekly Storm King\'s Thunder Adventure. Open to all members.', 3)";
	$s[47] = "insert into events(e_name, date, time, info, l_id) values('Session 6', '2023-05-23', 19, 'Session 6 of our weekly Storm King\'s Thunder Adventure. Open to all members.', 3)";
	$s[48] = "insert into events(e_name, date, time, info, l_id) values('Housing Tour', '2023-04-23', 12, 'A tour of UCF\'s on-campus housing. Open to all, regardless of enrollment status.', 1)";
	$s[49] = "insert into events(e_name, date, time, info, l_id) values('Housing Tour', '2023-04-25', 12, 'A tour of UCF\'s on-campus housing. Open to all, regardless of enrollment status.', 1)";
	$s[50] = "insert into events(e_name, date, time, info, l_id) values('Housing Tour', '2023-04-27', 12, 'A tour of UCF\'s on-campus housing. Open to all, regardless of enrollment status.', 1)";
	$s[51] = "insert into events(e_name, date, time, info, l_id) values('Sit in on COP4710', '2023-04-18', 13, 'A once in a lifetime opportunity to sit in on Dr. Vu\'s COP4710 lecture.', 2)";
	$s[52] = "insert into rso_events(e_id, rso_id) values (1,1)";
	$s[53] = "insert into rso_events(e_id, rso_id) values (2,1)";
	$s[54] = "insert into rso_events(e_id, rso_id) values (3,1)";
	$s[55] = "insert into rso_events(e_id, rso_id) values (4,1)";
	$s[56] = "insert into rso_events(e_id, rso_id) values (5,1)";
	$s[57] = "insert into rso_events(e_id, rso_id) values (6,1)";
	$s[58] = "insert into public_events(e_id, sa_id) values(7, 1)";
	$s[59] = "insert into public_events(e_id, sa_id) values(8, 1)";
	$s[60] = "insert into public_events(e_id, sa_id) values(9, 1)";
	$s[61] = "insert into private_events(e_id, a_id, sa_id) values(10, 2, 1)";
	
	
	
?>
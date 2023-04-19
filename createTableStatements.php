<?php 
	// File Written by Alex Varga
?>

<?php 
	$table0 = "create table Location (
		l_id	INT		AUTO_INCREMENT,
		l_name 	VARCHAR(30),
		address VARCHAR(255),
		info	VARCHAR(255),
		primary key(l_id)
	);";
	
	$table1 = "create table Users (
		u_id	INT		AUTO_INCREMENT,
		pass	VARCHAR(30),
		name	VARCHAR(30),
		uni_id	INT,
		primary key (u_id),
		foreign key (uni_id) references University(uni_id)
	);";
	
	$table2 = "create table Admins (
		u_id	INT,
		a_id	INT		AUTO_INCREMENT,
		primary key (a_id),
		foreign key (u_id) references users(u_id)
	);";

	$table3 = "create table SuperAdmins (
		u_id	INT,
		sa_id 	INT		AUTO_INCREMENT,
		primary key (sa_id),
		foreign key (u_id) references users(u_id)
	);";

	$table4 = "create table Events (
		e_id	INT		AUTO_INCREMENT,
		e_name	VARCHAR(30),
		date	VARCHAR(11),
		time	INT,
		info	VARCHAR(255),
		l_id 	INT(30) not null,
		primary key (e_id),
		foreign key (l_id) references Location(l_id)
	);";

	$table5 = "create table RSO (
		rso_id 	INT		AUTO_INCREMENT,
		a_id 	INT,
		uni_id	INT not null,
		name	VARCHAR(30),
		active  INT 	DEFAULT 0,
		info	VARCHAR(255),
		primary key (rso_id),
		foreign key (a_id) references Admins(a_id)
	);";
	
	$table6 = "create table University (
		uni_id	INT		AUTO_INCREMENT,
		uni_name VARCHAR(30),
		info	VARCHAR(30),
		sa_id	INT,
		primary key (uni_id),
		foreign key (sa_id) references SuperAdmin(sa_id)
	);";

	$table7 = "create table RSO_Events (
		e_id	INT,
		rso_id	INT not null,
		primary key (e_id),
		foreign key (e_id) references Events(e_id),
		foreign key (rso_id) references RSO(rso_id)
	);";

	$table8 = "create table Private_Events (
		e_id	INT,
		a_id 	INT,
		sa_id 	INT not null,
		primary key (e_id),
		foreign key (e_id) references Events(e_id),
		foreign key (a_id) references Admins(a_id),
		foreign key (sa_id) references SuperAdmins(sa_id)
	);";

	$table9 = "create table Public_Events (
		e_id	INT,
		a_id 	INT,
		sa_id 	INT not null,
		primary key (e_id),
		foreign key (e_id) references Events(e_id),
		foreign key (a_id) references Admins(a_id),
		foreign key (sa_id) references SuperAdmins(sa_id)
	);";

	$table10 = "create table Joins (
		u_id 	INT,
		rso_id 	INT,
		since	INT,
		primary key (u_id, rso_id),
		foreign key (u_id) references Users(u_id),
		foreign key (rso_id) references RSO(rso_id)
	);";


	$tables = [$table0, $table1, $table2, $table3, $table4, $table5, $table6, $table7, $table8, $table9, $table10];
?>
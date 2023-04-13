-- SQL statements for projectTest.php

-- Create Tables and Relationships

create table Location (
	l_name 	string,
	address string,
	primary key(name)
)

create table Users (
	u_id	integer,
	primary key (u_id)
)

create table Admins (
	u_id	integer,
	a_id	integer,
	primary key (u_id)
)

create table SuperAdmins (
	u_id	integer,
	sa_id 	integer,
	primary key (u_id)
)

create table Events (
	e_id	integer,
	time	integer,
	info	string,
	l_name 	string not null,
	primary key (e_id),
	foreign key (l_name) references Location
)

create table RSO (
	rso_id 	integer,
	a_id 	integer,
	primary key (rso_id),
	foreign key (a_id) references Admins
)

create table RSO_Events (
	e_id	integer,
	time	integer,
	info	string,
	l_name 	string not null,
	rso_id	integer not null,
	primary key (e_id),
	foreign key (l_name) references Location,
	foreign key (rso_id) references RSO
)

create table Private_Events (
	e_id	integer,
	time	integer,
	info	string,
	a_id 	integer not null,
	sa_id 	integer not null,
	primary key (e_id)
	foreign key (a_id) references Admins,
	foreign key (sa_id) references SuperAdmins
)

create table Private_Events (
	e_id	integer,
	time	integer,
	info	string,
	a_id 	integer not null,
	sa_id 	integer not null,
	primary key (e_id)
	foreign key (a_id) references Admins,
	foreign key (sa_id) references SuperAdmins
)

create table Joins (
	u_id 	integer,
	rso_id 	integer,
	primary key (u_id, rso_id),
	foreign key (u_id) references Users,
	foreign key (rso_id) references RSO
)

create table Comments (
	u_id 	integer,
	e_id 	integer,
	text 	string,
	rating 	integer,
	timestamp 	integer,
	primary key (u_id, e_id),
	foreign key (u_id) references Users,
	foreign key (e_id) references Events
)
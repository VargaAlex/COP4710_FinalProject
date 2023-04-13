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

create table Events (
	e_id	integer,
	time	integer,
	desc	string,
	l_name 	string not null,
	primary key (e_id),
	foreign key (l_name) references Location
)

create table RSO_Events (
	e_id	integer,
	time	integer,
	desc	string,
	primary key (e_id)
)

create table Private_Events (
	e_id	integer,
	time	integer,
	desc	string,
	primary key (e_id)
)

create table Public_Events (
	e_id	integer,
	time	integer,
	desc	string,
	primary key (e_id)
)


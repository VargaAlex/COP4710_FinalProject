create table location (
	l_id	INT,
	l_name 	VARCHAR(255),
	address VARCHAR(255),
	primary key(l_id)
);
create table users (
	u_id	INT,
	pass	VARCHAR(255),
	primary key (u_id)
);
create table Admins (
	u_id	INT,
	a_id	INT,
	primary key (u_id)
);

create table SuperAdmins (
	u_id	INT,
	sa_id 	INT,
	primary key (u_id)
);

create table Events (
	e_id	INT,
	time	INT,
	info	VARCHAR(255),
	l_name 	VARCHAR(255) not null,
	primary key (e_id),
	foreign key (l_name) references Location
);

create table RSO (
	rso_id 	INT,
	a_id 	INT,
	primary key (rso_id),
	foreign key (a_id) references Admins
);

create table RSO_Events (
	e_id	INT,
	time	INT,
	info	VARCHAR(255),
	l_name 	VARCHAR(255) not null,
	rso_id	INT not null,
	primary key (e_id),
	foreign key (l_name) references Location,
	foreign key (rso_id) references RSO
);

create table Private_Events (
	e_id	INT,
	time	INT,
	info	VARCHAR(255),
	a_id 	INT not null,
	sa_id 	INT not null,
	primary key (e_id)
	foreign key (a_id) references Admins,
	foreign key (sa_id) references SuperAdmins
);

create table Public_Events (
	e_id	INT,
	time	DATE,
	info	VARCHAR(255),
	a_id 	INT not null,
	sa_id 	INT not null,
	primary key (e_id)
	foreign key (a_id) references Admins,
	foreign key (sa_id) references SuperAdmins
);

create table Joins (
	u_id 	INT,
	rso_id 	INT,
	primary key (u_id, rso_id),
	foreign key (u_id) references Users,
	foreign key (rso_id) references RSO
);

create table Comments (
	u_id 	INT,
	e_id 	INT,
	text 	VARCHAR(255),
	rating 	INT,
	timestamp 	DATE,
	primary key (u_id, e_id),
	foreign key (u_id) references Users,
	foreign key (e_id) references Events
);
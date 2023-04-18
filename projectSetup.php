<?php 
	// File Written by Alex Varga
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newDB";



// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error)."<br>";
}

// Delete existing database
$sql = "DROP DATABASE ".$dbname;
if ($conn->query($sql) === TRUE) {
  echo "Former database deleted successfully. <br />";
} else {
  echo "Error deleting database: " . $conn->error."<br>";
}

// Create database
$sql = "CREATE DATABASE ".$dbname;
if ($conn->query($sql) === TRUE) {
  echo "New database created successfully. <br /><br />";
} else {
  echo "Error creating database: " . $conn->error."<br>";
}

$conn->close();

// Create connection with database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error)."<br>";
}

// sql to create table
include('createTableStatements.php');
include('defaultData.php');

foreach ($tables as $k => $sql){
	if ($conn->query($sql) === TRUE) {
	  echo "Table $k created successfully<br />";
	} else {
	echo "Error creating table $k: " . $conn->error . "<br />";
	}
}

foreach ($s as $k => $sql){
	if ($conn->query($sql) === TRUE) {
	  echo "Statement $k done successfully<br />";
	} else {
	echo "Error with statement $k: " . $conn->error . "<br />";
	}
}

$conn->close();
?>
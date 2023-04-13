<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectTest";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error)."<br>";
}

// Create database
$sql = "CREATE DATABASE ".$dbname;
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
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
$sql = "
-- SQL here
)";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newDB";
/*
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE ".$dbname;
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();
*/
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
/*
// Create database
$sql = "CREATE DATABASE ".$dbname;
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

// sql to create table
$sql = "create table Users (
	u_id	integer,
	primary key (u_id)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

// sql to insert values
$stmt = $conn->prepare("insert into Users (u_id) values (?)");
$stmt->bind_param("i", $value);

//set param and execute
for ($n = 0; $n <= 10; $n++) {
	$value = $n;
	$stmt->execute();
}
$stmt->close();

*/
$sql = "SELECT u_id from Users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["u_id"]."<br>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>
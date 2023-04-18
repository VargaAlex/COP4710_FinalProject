<?php 
	// File Written by Alex Varga
?>

<?php
	session_start();

	if(session_destroy()) {
		header("Location: index.php");
	}
?>
<?php
include 'db.php';
$dbconnection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$id = $_POST["id"];
$time = $_POST['time'];

    $query 	= "UPDATE tasks SET time = '{$time}' WHERE id = '{$id}'";
	if (!mysqli_query($dbconnection, $query)) {
	  	error_log("Error description: " . mysqli_error($dbconnection));
	} else {
		echo("Good to go");
	}

mysqli_close($dbconnection);
?>
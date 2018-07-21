<?php
include 'db.php';
$dbconnection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
date_default_timezone_set("America/New_York");
$emp_id = $_POST['empselect'];
$today = date("Y-m-d");
$task = $_POST['task'];
//$time = $_POST['time'];
$project = $_POST['project'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$time = ($end_time - $start_time)/3600;

error_log("start time: " . $start_time . " End Time: " . $end_time . " Time: " . $time);


    $query 	= "INSERT INTO tasks ( ";
	$query .= " employment_id, description, time, date, project, start_time, end_time";
	$query .= " ) VALUES ( ";
	$query .= " '{$emp_id}','{$task}', '{$time}', '{$today}', '{$project}', '{$start_time}', '{$end_time}' ";
	$query .= ")";
	if (!mysqli_query($dbconnection, $query)) {
	  	error_log("Error description: " . mysqli_error($dbconnection));
	} else {
		echo("Good to go");
	}

mysqli_close($dbconnection);
?>
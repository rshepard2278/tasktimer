<?php 
include 'db.php';
$dbconnection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT DISTINCT * FROM tasks";
$result = mysqli_query($dbconnection, $sql);
$json = array();
if(mysqli_num_rows($result)){
	while($row=$result->fetch_array()){
		$json[$row['id']][] = $row['project'];
	}
}
mysqli_close($dbconnection);
echo json_encode($json);


?>
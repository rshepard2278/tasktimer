<?php 
include 'db.php';
include 'times_counter.php';
$dbconnection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
date_default_timezone_set("America/New_York");
$today = date("Y-m-d");
$sql = "SELECT * FROM tasks WHERE date = '{$today}' ";
$result = mysqli_query($dbconnection, $sql);
$json = array();
$html = '';
//$times = array();
$times = 0;


if(mysqli_num_rows($result)){
	while($row = $result->fetch_array()){
		$start_time = $row['start_time'];
		$end_time = $row['end_time'];
		$total_time = $end_time - $start_time;
		$time_diff = $total_time/60/60;
		$time_obj = new times_counter($total_time);
		$total_time = $time_obj->format_seconds($total_time);
		$time_diff = round($time_diff, 2);
		$start_time = date('h:i', $start_time);
		$end_time = date('h:i', $end_time);
		$emp = $row['employment_id'];
		if ($emp == 1618) {
			$emp = "Ensign";
		} else if ($emp == 1204) {
			$emp = "Insight";
		} else {
			$emp = "Employer Unknown";
		}
		$post_action = htmlspecialchars($_SERVER["PHP_SELF"]);
		$date_obj = date_create($row['date']);
		$date = date_format($date_obj,"m/d/Y" );
		$html .= '<div class="row">
				  <div class="cell" data-title="Employer">
			        ' . $emp . '
			      </div>
			      <div class="cell" data-title="Project">
			        ' . $row['project'] . '
			      </div>
			      <div class="cell task-cell" data-title="Task">
			        ' . $row['description'] . '
			      </div>
			      <div class="cell" data-title="Date">
			        ' . $date . '
			      </div>			      
			      <div class="cell" data-title="Start Time">
			        ' . $start_time . '
			      </div>
  			      <div class="cell" data-title="End Time">
			        ' . $end_time . '
			      </div>
			      <div class="cell" data-title="Time Spent"><div id="edit-' . $row["id"] . '" onclick="editTime(' . $row["id"] . ', this)">
			        ' . $time_diff . '<input class="new-value" id="new-value-' . $row["id"] . '" name="new-value-' . $row["id"] . '" type="number" value="" style="display: none;"></div>
			      </div>
			    </div>' ;
			    //array_push($times, $total_time);
			    $times += $time_diff;
	}
	$counter = new times_counter($times);
	$html .= '<div class="row ">
			      <div class="cell  total-row" data-title="Project">
			        Total:
			      </div>
			      <div class="cell" data-title="Task">
			        
			      </div>
			      <div class="cell" data-title="Date">
			        
			      </div>
			      <div class="cell" data-title="Start Time">

			      </div>
  			      <div class="cell" data-title="End Time">

			      </div>
			      <div class="cell" data-title="End Time">

			      </div>
			      <div class="cell total-row" data-title="Time Spent">
			        ' . $times . '
			      </div>
			    </div>' ;
} else {
	$html .= '<div class="row">
	<div class="cell  total-row" data-title="Project">
			        No Projects Logged Yet
			      </div>
			      <div class="cell" data-title="Task">
			        
			      </div>
			      <div class="cell" data-title="Date">
			        
			      </div>
			      <div class="cell total-row" data-title="Time Spent">
			        
			      </div></div>' ;
}

mysqli_close($dbconnection);
echo $html;
?>
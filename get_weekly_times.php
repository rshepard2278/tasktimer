<?php 
include 'db.php';
include 'times_counter.php';
$dbconnection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
date_default_timezone_set("America/New_York");
$today = date("Y-m-d");
$begin_week = date('Y-m-d', strtotime('-7 days')); 
if(isset($_POST["start_date"])) {
	$begin_week = $_POST["start_date"]; 
} 
if($emp_no == 1618) {
	$sql = "SELECT * FROM tasks WHERE (date BETWEEN '{$begin_week}' AND '{$today}') AND employment_id = {$emp_no} ORDER BY date DESC, start_time";
} else if($emp_no == 1204) {
	$sql = "SELECT * FROM tasks WHERE (date BETWEEN '{$begin_week}' AND '{$today}') AND employment_id = {$emp_no} ORDER BY date DESC, project";
}

//echo $sql;
$result = mysqli_query($dbconnection, $sql);
$html = '';
//$times = array();
$times = 0;

if(mysqli_num_rows($result)){
	$counter = 0;
	while($row = $result->fetch_array()){
		$start_time = $row['start_time'];
		$end_time = $row['end_time'];
		$total_time = $end_time - $start_time;
		$time_diff = $row['time'];
		$time_obj = new times_counter($total_time);
		$total_time = $time_obj->format_seconds($total_time);
		$time_diff = round($time_diff, 2);
		$start_time = date('h:i', $start_time);
		$end_time = date('h:i', $end_time);
		$emp = $row['employment_id'];
		$date_obj = date_create($row['date']);
		$date = date_format($date_obj,"D m/d/Y" );
		if ($emp == 1618) {
			$emp = "Ensign";
		} else if ($emp == 1204) {
			$emp = "Insight";
		} else {
			$emp = "Employer Unknown";
		}
		$html .= '<div class="row" id="row-' . $counter . '">
				  <div class="cell date" data-title="Date">
			        ' . $date . '
			      </div>	
			      <div class="cell project" data-title="Project">' . $row['project'] . '</div>
			      <div class="cell task task-cell" data-title="Task">
			        ' . $row['description'] . '
			      </div>		      
			      <div class="cell start" data-title="Start Time">
			        ' . $start_time . '
			      </div>
  			      <div class="cell end" data-title="End Time">
			        ' . $end_time . '
			      </div>
			      <div class="cell" data-title="Time Spent"><div id="edit-' . $row["id"] . '" onclick="editTime(' . $row["id"] . ', this)">
			        ' . $time_diff . '</div>
			      </div>';
	    if($is_insight) {
	    	$html .= '<div class="cell remove data" data-title="Remove">
			      <button class="btn" onclick="$(\'#row-' . $counter . '\').addClass(\'gone\')"><i class="fa fa-close"></i></button>
			      </div>';
	    }
		
		$html .= '</div>' ;
			    //array_push($times, $total_time);
			    $times += $time_diff;
			    $counter++;
	}
	$counter = new times_counter($times);
	$html .= '<div class="row table-total-row">
			      <div class="cell total-row" data-title="Project">
			        TOTAL FOR WEEK:
			      </div>
			      <div class="cell project total-row " data-title="Task">
			        
			      </div>
			      <div class="cell date total-row" data-title="Date">
			        
			      </div>
			      <div class="cell start total-row" data-title="Start Time">

			      </div>
  			      <div class="cell end total-row" data-title="End Time">

			      </div>';
    if($is_insight) {
    	$html .= '<div class="cell end total-row" data-title="End Time">

			      </div>';	
	}
	$html .= '<div class="cell total total-row" data-title="Time Spent">
			        ' . $times . '
			      </div>
			    </div>' ;
} else {
	$html .= '<div class="row table-total-row">
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
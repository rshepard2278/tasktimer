<?php

function print_server_details() {
	echo '<pre>'.print_r($_SERVER, TRUE).'</pre>';
}
                    
function get_real_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function debug ($array_to_debug = null) {
	echo "<pre>";
	var_dump($array_to_debug);
	echo "</pre>";
}            

function get_report_form() {
    $emp_select = "";
    $insight_selected = '';
    $ensign_selected = '';
    if(isset($_POST['emp-select-top'])) {
        $emp_select = $_POST['emp-select-top'];
    }
    if ($emp_select == 1618) {
        $ensign_selected = "SELECTED";
    } else if ($emp_select == 1204) {
        $insight_selected = "SELECTED";
    } 
    $header_content =  '<form action="/timetracker/weekly_report.php" method="post">
                              <select name="emp-select-top" id="emp-select-top">
                                  <option value="1618" ' . $ensign_selected . '>Ensign</option>
                                  <option value="1204" ' . $insight_selected . '>Insight</option>
                              </select>
                              <input class="header-date-picker" id="start_date" name="start_date" onfocus="(this.type=\'date\')" class="js-form-control" placeholder="Start Date">
                              <input class="report-button" type="submit" value="Create Report">
                          </form>';
    return $header_content; 
}


?>
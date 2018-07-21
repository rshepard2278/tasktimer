<?php 
    $header_content =  '<form action="/timetracker/weekly_report.php" method="post">
                            <select name="emp-select-top" id="emp-select-top">
                                <option value="1618">Ensign</option>
                                <option value="1204">Insight</option>
                            </select>
                            <input class="report-button" type="submit" value="Generate Weekly Report">
                        </form>';
    include_once "head.php";
    include_once "header.php";
    $week_end_date = date("m/d/Y");
    $emp_no = $_POST['emp-select-top'];
    echo $emp_no;
    $emp = '';
    if ($emp_no == 1618) {
		$emp = "Ensign";
	} else if ($emp_no == 1204) {
		$emp = "Insight";
	} else {
		$emp = "Employer Unknown";
	}
?>
        <div class="main-container weekly-report">
            <div class="main wrapper clearfix">
                 <article>
                    <header>
                        <h1>Weekly Report for Week Ending <?php echo $week_end_date; ?>:</h1>
                       	<?php echo $emp; ?>
                    </header>
                   <!--  <section id="rows"> -->
                    <div class="wrapper">
                    	<div class="table" id="recent-table">
                            <div class="row header" id="table-header">
                                <div class="cell project">
                                Project
                                </div>
                                <div class="cell task">
                                Task
                                </div>
                                <div class="cell date">
                                Date
                                </div>
                                <div class="cell start">
                                Start Time
                                </div>
                                <div class="cell end">
                                End Time
                                </div>
                                <div class="cell total">
                                Time Spent
                                </div>
                            </div>
                        </div>
						<?php include_once "get_weekly_times.php"; ?>
                    </div>
                    <!-- </section> -->
                </article>
				<!--<aside class="time-container">
                </aside> -->


            </div> <!-- #main -->
        </div> <!-- #main-container -->
<?php
    $footer_content = '<a class="header-button" href="/timetracker"><input class="report-button" type="submit" value="< Back to TimeTracker"></a>';
    $is_home = false; ?>
    <div class="footer-container weekly-report">
    <?php    
    include_once "footer.php";
?>
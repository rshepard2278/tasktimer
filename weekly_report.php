<?php 
    include_once "functions.php";
    include_once "setup.php";
    $header_content = "";
    if ($is_admin) {
        $header_content =  get_report_form();
    }
    include_once "head.php";
    include_once "header.php";
    $week_end_date = date("m/d/Y");
    $emp_no = $_POST['emp-select-top'];
    echo $emp_no;
    $emp = '';
    $is_insight = false;
    if ($emp_no == 1618) {
		$emp = "Ensign";
	} else if ($emp_no == 1204) {
		$emp = "Insight";
        $is_insight = true;
	} else {
		$emp = "Employer Unknown";
	}
?>
        <div class="main-container weekly-report">
            <div class="main wrapper clearfix">
                
                 <article>
                    <header>
                        <h1>Weekly Report for Week Ending <?php echo $week_end_date; ?>:</h1>
                    </header>
                   <!--  <section id="rows"> -->
                    <div class="wrapper">
                    	<div class="table" id="recent-table">
                            <div class="row header" id="table-header">
                                <div class="cell date">
                                Date
                                </div>
                                <div class="cell project">
                                Project
                                </div>
                                <div class="cell task">
                                Task
                                </div>
                                <div class="cell start">
                                Start
                                </div>
                                <div class="cell end">
                                End
                                </div>
                                <div class="cell total">
                                Total
                                </div>
                                <?php if ($is_insight) {
                                    echo '<div class="cell remove">
                                Remove
                                </div>';
                                } ?>
                            </div>
                        </div>
						<?php include_once "get_weekly_times.php"; ?>
                    </div>
                    <!-- </section> -->
                    <?php //echo "<h3>Total: " . $times . "</h3>"; ?>
                </article>
				<!--<aside class="time-container">
                </aside> -->


            </div> <!-- #main -->
        </div> <!-- #main-container -->
<?php
    $footer_content = '<a class="header-button" href="/timetracker"><input class="report-button" type="submit" value="< TimeTracker"></a>';
    $is_home = false; ?>
    <div class="footer-container weekly-report">
    <?php    
    include_once "footer.php";
?>
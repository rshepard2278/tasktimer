<?php 
    include_once "functions.php";
    include_once "setup.php";
    $header_content = "";
    if ($is_admin) {
        $header_content =  get_report_form();
    }
    include_once "head.php";
    include_once "header.php";
?>
        <div class="main-container home">
            <div class="main wrapper clearfix">
                 <article>
                    <header>
                        <h1>Today's Tasks:</h1>

                    </header>
                   <!--  <section id="rows"> -->
                    <div class="wrapper">
                        <div class="table" id="recent-table">
                            <div class="row header" id="table-header">
                                <div class="cell employer">
                                Employer
                                </div>
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
                                Start 
                                </div>
                                <div class="cell end">
                                End 
                                </div>
                                <div class="cell total">
                                Total
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </section> -->
                </article>
                <aside class="time-container">
<!--                     <h3 class="current-task">Timer</h3>
                     -->
                    <div class="time-container">
                        <h1 class="counter">
                            <span id="sw_h">00</span>:
                            <span id="sw_m">00</span>:
                            <span id="sw_s">00</span>                        
                            <span id="sw_ms">00</span>
                        </h1>
                        <span id="sw_status">Idle</span>
                        <br/>
                        <input type="button" value="Start" id="sw_start"  class="button"/>
                        <input type="button" value="Pause" id="sw_pause" disabled class="button"/>
                        <input type="button" value="Stop"  id="sw_stop"  disabled class="button"/>
                        <input type="button" value="Reset" id="sw_reset"  class="button"/>
                        <select id="emp-select">
                            <option value="default">Please Select</option>
                            <option value="1618">Ensign</option>
                            <option value="1204">Insight</option>
                        </select>
<!--                         <select id="project-select" onchange="fillProject()">
                            <option>Default</option>
                        </select>
                        <br> -->
                        <input class="task-input"  type="text" id="project" name="project" placeholder="Project" list="project-list" required />
                        <div id="suggesstion-project"></div>
                        <select id="task-select" onchange="fillTask()">
                            <option>Default</option>
                        </select>                        
                        <input class="task-input" type="text" id="task" name="task" placeholder="Task" required /><br />
                    </div>
                </aside>


            </div> <!-- #main -->
        </div> <!-- #main-container -->
<?php
    $footer_content = "";
    $is_home = true; ?>
    <div class="footer-container home">
    <?php    
    include_once "footer.php";





?>

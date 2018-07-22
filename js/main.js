
/*

JQUERY: STOPWATCH & COUNTDOWN

This is a basic stopwatch & countdown plugin to run with jquery. Start timer, pause it, stop it or reset it. Same behaviour with the countdown besides you need to input the countdown value in seconds first. At the end of the countdown a callback function is invoked.

Any questions, suggestions? marc.fuehnen(at)gmail.com

*/

var startTime = new Date;
var endTime = new Date;

function editTime(id, parentElement, startTime) {
    $(parentElement).prop('onclick',null).off('click');
    //console.log("edit called for " + id);
    var inputID = "input-" + id;
    var parentID = $(parentElement).attr('id');
    $('#' + parentID).html('<input class="new-value" id="' + inputID + '" name="new-value" type="number">');
    $('#' + inputID).focus();
    var newValueInput = $(parentElement).find('input');
    $(newValueInput).css("display","block");
    $(newValueInput).keyup(function(event) {
        if (event.keyCode === 13) { 
            var value = $(newValueInput).val();
            pressedEnter(value, id);
            $('#' + parentID).html(value);
        }
    });
}



function pressedEnter(value, id) {
    $.post("update_time.php",
        {
        id: id,
        time: value,
        },
        
        function(data,status){
            
        });
}

$(document).ready(function() {
    $('.new-value').hide();
    (function($){
        $.extend({
            APP : {                
                
                formatTimer : function(a) {
                    if (a < 10) {
                        a = '0' + a;
                    }                              
                    return a;
                },    
                
                startTimer : function(dir) {  
                    var a;
                    // save type
                    $.APP.dir = dir;
                    // get current date
                    $.APP.d1 = new Date();
                    switch($.APP.state) {
                            
                        case 'pause' :
                            
                            // resume timer
                            // get current timestamp (for calculations) and
                            // substract time difference between pause and now
                            $.APP.t1 = $.APP.d1.getTime() - $.APP.td;                            
                        break;
                            
                        default :
                            
                            // get current timestamp (for calculations)
                            $.APP.t1 = $.APP.d1.getTime(); 
                            
                            // if countdown add ms based on seconds in textfield
                            if ($.APP.dir === 'cd') {
                                $.APP.t1 += parseInt($('#cd_seconds').val())*1000;
                            }    
                        break;
                    }                                   
                    
                    // reset state
                    $.APP.state = 'alive';   
                    $('#' + $.APP.dir + '_status').html('Running');
                    
                    // start loop
                    $.APP.loopTimer();
                },
                
                pauseTimer : function() {
                    
                    // save timestamp of pause
                    $.APP.dp = new Date();
                    $.APP.tp = $.APP.dp.getTime();
                    
                    // save elapsed time (until pause)
                    $.APP.td = $.APP.tp - $.APP.t1;
                    
                    // change button value
                    $('#' + $.APP.dir + '_start').val('Resume');
                    
                    // set state
                    $.APP.state = 'pause';
                    $('#' + $.APP.dir + '_status').html('Paused');
                    
                },
                
                stopTimer : function() {
                    
                    // change button value
                    $('#' + $.APP.dir + '_start').val('Start New');                    
                    // set state
                    $.APP.state = 'stop';
                    $('#' + $.APP.dir + '_status').html('Stopped');
                    
                },
                
                resetTimer : function() {

                    // reset display
                    $('#' + $.APP.dir + '_ms,#' + $.APP.dir + '_s,#' + $.APP.dir + '_m,#' + $.APP.dir + '_h').html('00');                 
                    
                    // change button value
                    $('#' + $.APP.dir + '_start').val('Start');                    
                    
                    // set state
                    $.APP.state = 'reset';  
                    $('#' + $.APP.dir + '_status').html('Reset & Idle again');
                    
                },
                
                endTimer : function(callback) {
                   
                    // change button value
                    $('#' + $.APP.dir + '_start').val('Restart');
                    
                    // set state
                    $.APP.state = 'end';
                    
                    // invoke callback
                    if (typeof callback === 'function') {
                        callback();
                    }    
                    
                },    
                
                loopTimer : function() {
                    
                    var td;
                    var d2,t2;
                    
                    var ms = 0;
                    var s  = 0;
                    var m  = 0;
                    var h  = 0;
                    
                    if ($.APP.state === 'alive') {
                                
                        // get current date and convert it into 
                        // timestamp for calculations
                        d2 = new Date();
                        t2 = d2.getTime();   
                        
                        // calculate time difference between
                        // initial and current timestamp
                        if ($.APP.dir === 'sw') {
                            td = t2 - $.APP.t1;
                        // reversed if countdown
                        } else {
                            td = $.APP.t1 - t2;
                            if (td <= 0) {
                                // if time difference is 0 end countdown
                                $.APP.endTimer(function(){
                                    $.APP.resetTimer();
                                    $('#' + $.APP.dir + '_status').html('Ended & Reset');
                                });
                            }    
                        }    
                        
                        // calculate milliseconds
                        ms = td%1000;
                        if (ms < 1) {
                            ms = 0;
                        } else {    
                            // calculate seconds
                            s = (td-ms)/1000;
                            if (s < 1) {
                                s = 0;
                            } else {
                                // calculate minutes   
                                var m = (s-(s%60))/60;
                                if (m < 1) {
                                    m = 0;
                                } else {
                                    // calculate hours
                                    var h = (m-(m%60))/60;
                                    if (h < 1) {
                                        h = 0;
                                    }                             
                                }    
                            }
                        }
                      
                        // substract elapsed minutes & hours
                        ms = Math.round(ms/100);
                        s  = s-(m*60);
                        m  = m-(h*60);                                
                        
                        // update display
                        $('#' + $.APP.dir + '_ms').html($.APP.formatTimer(ms));
                        $('#' + $.APP.dir + '_s').html($.APP.formatTimer(s));
                        $('#' + $.APP.dir + '_m').html($.APP.formatTimer(m));
                        $('#' + $.APP.dir + '_h').html($.APP.formatTimer(h));
                        var timeDisplay = h + ":" + m + ":" + s;
                        document.title = timeDisplay + " | " + $('#project').val();;
                        
                        // loop
                        $.APP.t = setTimeout($.APP.loopTimer,1);
                    
                    } else {
                        // kill loop
                        clearTimeout($.APP.t);
                        return true;                    
                    }                      
                }   
            }            
        });

        $('#sw_start').live('click', function() {
            $.APP.startTimer('sw');
            $("#favicon").attr("href","favicon-green.ico");
            $('#sw_start').prop("disabled",true);
            $('#sw_stop').prop("disabled",false);
            $('#sw_pause').prop("disabled",false);
            startTime = new Date;
            startTime = startTime.getTime();
            startTime = Math.floor(startTime / 1000);
            console.log("Start Time:  " + startTime);
        });    

        $('#cd_start').live('click', function() {
            $.APP.startTimer('cd');
            //alert("Start Time:  " + startTime);
        });           
        
        $('#sw_stop,#cd_stop').live('click', function() {
            var hour = $('#sw_h').html();
            var min = $('#sw_m').html();
            var task = $('#task').val();
            var project = $('#project').val();
            var empselect = $("#emp-select").val();
            if (empselect == "default") {
                alert("Please Select Employer");
            }
            console.log(empselect);
            console.log("1Time " + hour + ":" + min + ' Task ' + task );
            endTime = new Date;
            endTime = endTime.getTime();
            endTime = Math.floor(endTime / 1000);
            if(task.length != 0 ) {
                $.APP.stopTimer();
                $("#favicon").attr("href","favicon.ico");
                $('#sw_start').prop("disabled",false);
                $('#sw_pause').prop("disabled",true);
                $('#sw_stop').prop("disabled",true);
                console.log("Time " + hour + ":" + min + ' Task ' + task );
                $.post("save_to_db.php",
                {
                task: task,
                start_time: startTime,
                end_time: endTime,
                project: project,
                empselect: empselect,
                },
                
                function(data,status){
                  loadContent();
                  fillTask();
                });
            } else {
                alert("Select Task");
            }

            console.log("End time: " + endTime);
        });
        
        $('#sw_reset,#cd_reset').live('click', function() {
            $.APP.resetTimer();
        });  
        
        $('#sw_pause,#cd_pause').live('click', function() {
            $.APP.pauseTimer();
            $("#favicon").attr("href","favicon.ico");
            $('#sw_start').prop("disabled",false);
            $('#sw_pause').prop("disabled",true);
        });                
    })(jQuery);
});

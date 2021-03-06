<?php


class times_counter {

    private $hou = 0;
    private $min = 0;
    private $sec = 0;
    private $totaltime = '00:00:00';

    public function __construct($times){
        
        if(is_array($times)){

            $length = sizeof($times);

            for($x=0; $x <= $length; $x++){
                    $split = explode(":", @$times[$x]); 
                    $this->hou += @$split[0];
                    $this->min += @$split[1];
                    $this->sec += @$split[2];
            }

            $seconds = $this->sec % 60;
            $minutes = $this->sec / 60;
            $minutes = (integer)$minutes;
            $minutes += $this->min;
            $hours = $minutes / 60;
            $minutes = $minutes % 60;
            $hours = (integer)$hours;
            $hours += $this->hou % 24;
            $spacer = "";
            $spacer_2 = "";
            $spacer_3 = "";
            $minutes = $minutes/60;
            $minutes = round($minutes, 2);
            $minutes = substr($minutes, 1);
            $this->totaltime = $spacer . $hours . $minutes;
        }
    }

    public function get_total_time(){
        return $this->totaltime;
    }

    public function format_seconds($seconds) {
        $t = round($seconds);
        return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
    }

}
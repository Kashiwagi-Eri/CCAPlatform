<?php
      //////////////////////////////////////
      //author: LIN
      //function: build timeslot with input date
      //////////////////////////////////////
define("SESSION_DURATION", 45);
function build_timeslot($date, $month, $year) {
    require_once('schedule_model.php');
    #TODO: fixed input

    $timeslot = "<table class='table col-md-8 table-bordered' id='schedule'>";
    $timeslot .= "<caption id='tbs'>Time Slots</caption>";

    $status = get_timeslot_status('20230301');
    $prev_coach = "";
    $counter_flag = 0;
    foreach ($status as $key => $value) {
        
        if ($prev_coach!=$value['coach']){
          $counter_flag = $counter_flag + 1;
          if($counter_flag>1){
            $timeslot .= "</tr>";
          }
          $prev_coach = $value['coach'];
          $timeslot .= "<tr>";
          $timeslot .= "<td>{$value['coach']}</td>";
          $endtime_str = time_string_add($value['timeslot']);
          $final_start_time = substr_replace($value['timeslot'], ':', 2, 0);
          $final_end_time = substr_replace($endtime_str, ':', 2, 0);
          $timeslot_str = $final_start_time . ' - ' . $final_end_time;
          $timeslot .= "<td>{$timeslot_str}</td>";
        }else{
          $endtime_str = time_string_add($value['timeslot']);
          $final_start_time = substr_replace($value['timeslot'], ':', 2, 0);
          $final_end_time = substr_replace($endtime_str, ':', 2, 0);
          $timeslot_str = $final_start_time . ' - ' . $final_end_time;
          $timeslot .= "<td>{$timeslot_str}</td>";
        }

    }
    $timeslot .= "</tr>";
    $timeslot .= "</table>";
    #print($timeslot);

    return $timeslot;
}
/*
function ($uid, $date){
    
}*/

function time_string_add($time_str){
  $hour_string = substr($time_str, 0,2);
  $min_string = substr($time_str, 2,2);
  $hour_int=intval($hour_string);
  $min_int=intval($min_string);
  $new_hour_int = 0;
  $new_min_int = 0;
  if ($min_int + SESSION_DURATION>=60){
    $new_min_int = ($min_int + SESSION_DURATION)%60;
    $new_hour_int = $hour_int + 1;
  }else{
    $new_min_int = $min_int + SESSION_DURATION;
    $new_hour_int = $hour_int;
  }
  
  $new_min_string = strval($new_min_int);
  $new_hour_string = strval($new_hour_int);

  if($new_min_int<10){
    $new_min_string =  '0' . $new_min_string;
  }
  if($new_hour_int<10){
    $new_hour_string =  '0' . $new_hour_string;
  }

  $new_time_str = $new_hour_string . $new_min_string;

  return $new_time_str;

}
/*
<table class="table col-md-8 table-bordered" id="schedule">
        <caption id="tbs">Time Slots</caption>
        <tr>
          <td>Amy Leung</td>
          <td>09:30 - 10:15</td>
          <td>10:15 - 11:00</td>
          <td>11:00 - 11:45</td>
        </tr>
        <tr>
          <td>Steve Man</td>
          <td>11:45 - 12:30</td>
          <td>12:30 - 13:15</td>
          <td>14:00 - 14:45</td>
          <td>14:45 - 15:30</td>
        </tr>
        <tr>
          <td>Winnie Lee</td>
          <td>15:30 - 16:15</td>
          <td>16:15 - 17:00</td>
          <td>17:00 - 17:45</td>
        </tr>
</table>
*/
?>
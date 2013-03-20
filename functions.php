<?php
function secs_to_string ($secs, $long=false) {
  // reset hours, mins, and secs we'll be using
  $hours = 0;
  $mins = 0;
  $secs = intval ($secs);
  $t = array(); // hold all 3 time periods to return as string
  
  // take care of mins and left-over secs
  if ($secs >= 60) {
    $mins += (int) floor ($secs / 60);
    $secs = (int) $secs % 60;
        
    // now handle hours and left-over mins    
    if ($mins >= 60) {
      $hours += (int) floor ($mins / 60);
      $mins = $mins % 60;
    }
    // we're done! now save time periods into our array
    $t['hours'] = (intval($hours) < 10) ? "0" . $hours : $hours;
    $t['mins'] = (intval($mins) < 10) ? "0" . $mins : $mins;
  }

  // what's the final amount of secs?
  $t['secs'] = (intval ($secs) < 10) ? "0" . $secs : $secs;
  
  // decide how we should name hours, mins, sec
  $str_hours = ($long) ? "hour" : "hour";

  $str_mins = ($long) ? "minute" : "min";
  $str_secs = ($long) ? "second" : "sec";

  // build the pretty time string in an ugly way
  $time_string = "";
  $time_string .= ($t['hours']) ? $t['hours'] . " $str_hours" . ((intval($t['hours']) == 1) ? "" : "s") : "";
  $time_string .= ($t['mins']) ? (($t['hours']) ? ", " : "") : "";
  $time_string .= ($t['mins']) ? $t['mins'] . " $str_mins" . ((intval($t['mins']) == 1) ? "" : "s") : "";
  $time_string .= ($t['hours'] || $t['mins']) ? (($t['secs'] > 0) ? ", " : "") : "";
  $time_string .= ($t['secs']) ? $t['secs'] . " $str_secs" . ((intval($t['secs']) == 1) ? "" : "s") : "";

  return empty($time_string) ? 0 : $time_string;
}

// do the same as above in "hh:mm:ss" format
function secs_to_string_compact ($secs) {
  // grab the string return by the above function
  // and format begin formatting it
  $str = secs_to_string ($secs);
  

  if (!$str) return 0;
    
    $hour_pos = strpos ($str, "hour");
    $min_pos = strpos ($str, "min");
    $sec_pos = strpos ($str, "sec");
    
    $h = ($hour_pos) ? intval (substr ($str, 0, $hour_pos)) : 0;
    $m = ($min_pos) ? intval (substr ($str, $min_pos - 3, $min_pos)) : 0;
    $s = ($sec_pos) ? intval (substr ($str, $sec_pos - 3, $sec_pos)) : 0;
    
    $h = ($h < 10) ? "0" . $h : $h;
    $m = ($m < 10) ? "0" . $m : $m;
    $s = ($s < 10) ? "0" . $s : $s;
    
    return ("$h:$m:$s");
}


/*
 * Convert seconds to human readable text.
 *
 */
function secs_to_h($secs)
{
        $units = array(
                "week"   => 7*24*3600,
                "day"    =>   24*3600,
                "hour"   =>      3600,
                "minute" =>        60,
                "second" =>         1,
        );

  // specifically handle zero
        if ( $secs == 0 ) return "0 seconds";

        $s = "";

        foreach ( $units as $name => $divisor ) {
                if ( $quot = intval($secs / $divisor) ) {
                        $s .= "$quot $name";
                        $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                        $secs -= $quot * $divisor;
                }
        }

        return substr($s, 0, -2);
}
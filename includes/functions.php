<?php

    function sanitize_data($input){
        return trim(htmlspecialchars(stripcslashes($input)));
    }

    date_default_timezone_set('Africa/Lagos');
    // echo time_ago('2020-12-01 11:18:00');

    function time_ago($timestamp){
        $Time_ago = strtotime($timestamp);
        $current_time = time();
        $time_diff = $current_time - $Time_ago;
        $seconds = $time_diff;
        $minutes = round($seconds / 60); //value 60 is seconds.
        $hours = round($seconds / 3600); //value 3600 is 60 minutes.
        $days = round ($seconds / 86400); //value 86400 is a day(86400 = 24 * 60 * 60).
        $weeks = round($seconds / 604800); //7 * 24* 60 * 60.
        $months = round($seconds /2629440); // ((365+365+365+365+365) / 5/12)*24*60*60
        $years = round($seconds / 31553280); //(365+365+365+365+365+365 /5*24*24*60*60)
        
        if($seconds <= 60){
            return "Just Now";
        }else if ($minutes <= 60) {
            if($minutes ==1){
                return "one minute ago";
            }else{
                return "$minutes minutes ago";
            }
        }else if ($hours <=24){
            if($hours ==1){
                return "an hour ago";
            }else{
                return "$hours hrs ago";
            }
        }else if ($days <= 7){
            if ($days ==1){
                return "yesterday";
            }else {
                return "$days days ago";
            }
        }else if ($weeks <= 4.3) {
            if ($weeks == 1){
                return "a week ago";
            }else{
                return "$weeks weeks ago";
            }
        }else if ($months <= 12){
            if ($months == 1){
                return "a months ago";
            }else{
                return "$months months ago";
            }
        }else {
            if ($years == 1){
                return "one year ago";
            }else {
                return "$years years ago";
            }
        }
    }

?>
<?php

// dosya: app/helpers.php
function is_active($url, $className = 'bg bg-dark text-light p-2')
{
    return request()->is($url) ? $className : null;
}


function timeAgo($date = "now")
{
    $timestamp = strtotime($date);
    $currentDate = new DateTime('@'.$timestamp);
    $nowDate = new DateTime('@' . time());
    return $currentDate->diff($nowDate)->format("%y year %m month %d day %H hour %i minutes %s secconds");
}

// $date = "Thu Jul 16 01:19:16 2020";

// echo timeAgo($date);

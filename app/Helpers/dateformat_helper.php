<?php

if(!function_exists('changeDateFormat'))
{
    function changeDateFormat($originalDate)
    {
        return date('d-M-Y', strtotime($originalDate));
    }
}
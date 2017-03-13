<?php
function smarty_modifier_date($string, $format = null) 
{
    if(is_numeric($string)){
        $time = $string;
    }else{
        $time = strtotime($string);
    }
    return date($format, $time);
}

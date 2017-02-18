<?php
function smarty_modifier_date($string, $format = null, $default_date = '', $formatter = 'auto')
{
    $time = strtotime($string);
	return date($format,$time);
}

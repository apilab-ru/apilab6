<?php

function smarty_function_utils($params)
{
    $name = $params['name'];
    unset($params['name']);
    $name = "\core\utils\\$name";
    return $name::widget($params);
}

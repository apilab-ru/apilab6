<?php

function smarty_function_widget($params)
{
    $name = $params['name'];
    unset($params['name']);
    $name = "\core\widget\\$name\\widget";
    return (new $name())->run($params);
}

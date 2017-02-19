<?php

function pr(){
    echo "<pre>";
    foreach(func_get_args() as $item){
        print_r($item);
        echo PHP_EOL;
    }
    echo "</pre>";
}

function dlog($name,$arg){
    
    $arg = print_r($arg,true);
    
    \core\Core::$app->db()->insert('log',[
        'name' => $name,
        'arg'  => $arg
    ]);
}
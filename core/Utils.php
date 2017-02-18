<?php

function pr(){
    echo "<pre>";
    foreach(func_get_args() as $item){
        print_r($item);
    }
    echo "</pre>";
}

function dlog($name,$arg){
    
    $arg = print_r($arg,true);
    
    \core\Application::$db->insert('log',[
        'name' => $name,
        'arg'  => $arg
    ]);
}
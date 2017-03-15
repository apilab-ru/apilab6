<?php

function autoLoader($class){
    
    $app = dirname(__FILE__) . "/../";
    
    if(strpos($class,'\\')){
        $class = explode('\\',$class);
        $file = implode("/",$class);
        if(file_exists($app.$file.".php")){
            include $app.$file.".php";
        }
    }
    
}

spl_autoload_register('autoLoader');
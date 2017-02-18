<?php

function autoLoader($class){
    
    $core = dirname(__FILE__);
    
    if(strpos($class,'\\')){
        $class = explode('\\',$class);
        if($class[0]=='core'){
            $file = "{$core}/{$class[1]}/{$class[2]}.php";
            include $file;
        }
    }
    
}

spl_autoload_register('autoLoader');
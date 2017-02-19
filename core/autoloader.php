<?php

function autoLoader($class){
    
    $app = dirname(__FILE__) . "/../";
    
    if(strpos($class,'\\')){
        $class = explode('\\',$class);
        
        $file = implode("/",$class);
        
        include $app.$file.".php";
        
        /*if($class[0]=='core'){
            
            /*$file = "{$core}/{$class[1]}/{$class[2]}.php";
            include $file;*/
            
        /*}else{
        }*/
    }
    
}

spl_autoload_register('autoLoader');
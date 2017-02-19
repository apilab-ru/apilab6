<?php

namespace core\controllers;

class ControllerBase{
    
    function render($name,$arg=null){
        
        $class = explode("\\",get_class($this));
        
        if(is_array($name)){
            
            $type = $name[0];
            switch($type){
                case 'custom':
                    $tpl = 'custom/'.$class[1] ."/".$name[1].".tpl";
                    break;
            }
            
        }else{
            //Шаблон в модуле
            unset( $class[count($class)-1] );
            $dir = implode("/",$class) . "/view/" ;
            
            $tpl = $dir.$name.".tpl";
        }
        
        return \core\Core::$app->render($tpl,$arg);
    }
    
}
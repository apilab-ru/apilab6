<?php


namespace core\utils;

class Css {
    
    static function widget($params){
        
        $core = ($params['core']) ? $params['core'] : 1;
        $modules = ($params['modules']) ? $params['modules'] : 1;
        $list = \core\Core::$app->getCss();
        $list = array_merge($list['core'],$list['add']);
        
        foreach($list as $item){
            echo "<link rel='stylesheet' type='text/css' href='{$item}.css'/>";
        }
        
    }
    
}

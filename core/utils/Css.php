<?php


namespace core\utils;

class Css 
{
    
    static function widget($params)
    {
        
        $list = \core\Core::$app->getCss();
        
        if($params['module']){
            $list = $list[ $params['module'] ];
        }else{
            $list = array_merge($list['core'],$list['add']);
        }
        
        foreach($list as $item){
            echo "<link rel='stylesheet' type='text/css' href='{$item}'/>";
        }
        
    }
    
}

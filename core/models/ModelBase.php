<?php

namespace core\models;

class ModelBase 
{
    
    function __construct() 
    {
        $this->db = \core\Core::$app->db();
        $this->core = \core\Core::$app;
    }
    
    function extendFilter($set,$default)
    {
        if($set){
            foreach($set as $key=>$val){
                $default[$key] = $val;
            }
        }
        return $default;
    }
    
}

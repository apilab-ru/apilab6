<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\utils;

/**
 * Description of Js
 *
 * @author Dekim
 */
class Js 
{
    
    static function widget($param)
    {
        
        $list = \core\Core::$app->getJs();
        
        if($param['module']){
            $list = $list[ $param['module'] ];
        }else{
            $list = array_merge($list['core'],$list['add']);
        }
        
        foreach($list as $item){
            echo "<script src='{$item}'></script>";
        }
    }
    
}

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
        
        $data = \core\Core::$app->getJs();
        
        if($param['module']){
            $list = $data[ $param['module'] ];
        }else{
            $list = array_merge($data['core'],$data['add']);
        }
        
        foreach($list as $item){
            echo "<script src='{$item}'></script>";
        }
        
        if(!$param['module']){
        echo "<script>";  
            foreach($data['plugin'] as $name=>$link){
                echo "regRes.add('$name',".json_encode($link).")";
            }
        echo "</script>";
        }
    }
    
}

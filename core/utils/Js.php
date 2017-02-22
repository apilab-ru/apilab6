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
class Js {
    
    static function widget($param){
        
        if($param['current']){
            if($param['current']=='jqary'){
                if(DEVELOP){
                    $src = '/source/js/jquery.min.js';
                }else{
                    $src = '//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js';
                }
                echo "<script src='{$src}'></script>";
            }
        }
        
        $list = \core\Core::$app->getJs();
        
        $list = array_merge($list['core'],$list['add']);
        
        foreach($list as $item){
            echo "<script src='{$item}'></script>";
        }
    }
    
}

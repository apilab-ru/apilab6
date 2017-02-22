<?php

namespace core\api;

class vk {
    
    function authByWindget($param){
        return array(
            'vk_id'=>$param['uid'],
            'name'=>$param['first_name'] . " " . $param['last_name']
        );
    }
    
}

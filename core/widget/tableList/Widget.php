<?php

namespace core\widget\tableList;

class Widget extends \core\widget\WidgetBase 
{
    
    function run($param)
    {
        
        $labels = $param['labels'];
        $list = $param['list'];
        
        $filters = array();
        if($param['filters']){
            $filters = $param['filters'];
        }else{
            foreach($label as $key=>$name){
                $filters[$key] = 'text';
            }
        }
        
        return $this->render("run",[
            'list'=>$list,
            'labels'=>$labels,
            'filters'=>$filters,
            'actions'=>$param['actions']
        ]);
    }
}

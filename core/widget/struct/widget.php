<?php

namespace core\widget\struct;


class widget extends \core\widget\WidgetBase
{
    
    function run($params=null)
    {
        $list = \core\Core::$app->getStruct();
        
        if($params['all']){
            array_unshift($list,array(
                'id'=>0,
                'name'=>'Все разделы'
            ));
        }
        
        if(isset($params['struct'])){
            foreach($list as $key=>$item){
                if($item['id']==$params['struct']){
                   $list[$key]['check'] = 1; 
                }
            }
        }
        
        echo $this->render("run",[
            'list'=>$list,
            'func'=>$params['func']
        ]);
    }
    
}

<?php

namespace core\widget\struct;


class Widget extends \core\widget\WidgetBase
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
            $list = $this->findStruct($list,$params['struct']);
        }
        
        if($params['tpl']=='select'){
            echo $this->render('select',[
                'list'=>$list,
                'struct'=>$params['struct'],
                'before'=>''
            ]);
        }else{
            echo $this->render("run",[
                'list'=>$list,
                'func'=>$params['func']
            ]);
        }
    }
    
    function findStruct($list,$struct,&$check=0)
    {
        foreach($list as $key=>$item){
            if($item['id']==$struct){
                $list[$key]['check'] = 1;
                $check = 1;
            }elseif($item['childNodes']){
                $check = 0;
                $list[$key]['childNodes'] = $this->findStruct($item['childNodes'],$struct,$check);
                if($check){
                    $list[$key]['check'] = 1;
                }
            }
        }
        return $list;
    }
    
}
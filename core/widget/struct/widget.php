<?php

namespace core\widget\struct;


class widget extends \core\widget\WidgetBase
{
    
    function run($params=null)
    {
        $list = \core\Core::$app->getStruct();
        
        echo $this->render("run",[
            'list'=>$list,
            'func'=>$params['func']
        ]);
    }
    
}

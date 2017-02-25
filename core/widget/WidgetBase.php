<?php

namespace core\widget;

class WidgetBase 
{
    
    function render($tpl,$arg=null)
    {
        $class = explode("\\",get_class($this));
        $tpl = "core/widget/{$class[2]}/view/$tpl.tpl";
        return \Core\Core::$app->render($tpl,$arg);
    }
    
}

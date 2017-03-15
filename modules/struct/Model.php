<?php

namespace modules\struct;

class Model extends \core\models\ModelBase
{
    function getStructList($page)
    {
        $list = \core\Core::$app->getStruct();
        $list = $this->findStruct($list,$page['id']);
        return $list;
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

<?php

namespace modules\struct;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    function __construct($param) 
    {
        $this->model = new Model($param);
    }
    
    function blockMenu($block,$config,$pages)
    {
        return [
            'data'=>[
                'list'=>$this->model->getStructList($pages[0])
             ]
        ];
    }
}


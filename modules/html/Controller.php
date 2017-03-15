<?php

namespace modules\html;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    function __construct($param = null) {
        $this->model = new Model($param);
    }

    function blockHtml($block,$config)
    {
        return [
            'data'=>['html'=>$this->model->getHtmlBlock($config['id'])],
            'tpl'=>'html'
        ];
    }
    
    
}


<?php

namespace modules\log;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    function __construct($set) {
        $this->set = $set;
        $this->model = new Model();
    }
    
    function ActionList()
    {
        $data = $this->model->getList();
        echo $this->render('list',$data);
    }
    
    function AjaxClear()
    {
        $this->model->clearAll();
    }
    
}


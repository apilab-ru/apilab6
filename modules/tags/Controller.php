<?php

namespace modules\tags;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    function __construct($set) 
    {
        $this->set = $set;
        $this->model = new Model();
    }
    
    function getTagsObject($object,$id)
    {
        return $this->model->getTagsObject($object,$id);
    }
    
    function getList()
    {
        return $this->model->getList();
    }
    
}


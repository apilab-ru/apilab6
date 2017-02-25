<?php

namespace core\utils;

class View
{
    
    function __construct()
    {
        include __DIR__ ."/../libs/smarty/setup.php";
        $this->sm = initSmarty();
    }
    
    function render($tpl,$args=null)
    {
        $this->sm->assign($args);
        $this->sm->assign('tplPath',$tpl);
        return $this->sm->fetch("app:".$tpl);
    }
    
}
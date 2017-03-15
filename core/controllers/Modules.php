<?php

namespace core\controllers;
use core\utils\ErrorClass;

class Modules 
{
    function __construct($set)
    {
        $this->set = $set;
    }
    
    function __get($name)
    {
        $class = "\\modules\\$name\Controller";
        if(!class_exists($class)){
           return new ErrorClass($name);
        }else{
           return $this->$name = new $class( $this->set[$name] ); 
        }
    }
}
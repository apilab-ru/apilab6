<?php

namespace core\utils;

class ErrorClass
{
    function __construct($name,$model=1)
    {
        $this->name = $name;
    }
    
    function __get($name)
    {
        return $this;
    }
    
    function __toString() 
    {
        return "Модуль ".$this->name. " не найден.";
    }
    
    function __call($name,$arguments){
        if($name=='block'){
            $name = $arguments[0];
        }
        return "Модуль ".$this->name. " Метод $name не найден. ";
    }
}
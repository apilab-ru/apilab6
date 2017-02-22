<?php


namespace core\controllers;

class Modules {
    
    function __construct($set){
        $this->set = $set;
    }
    
    function __get($name){
        $class = "\\modules\\$name\Controller";
        $this->$name = new $class( $this->set[$name] );
        return $this->$name;
    }
    
}

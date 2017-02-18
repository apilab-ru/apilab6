<?php

namespace core;

class Application{
    
    static $db;
    
    static $view;
    
    function __construct($config){
        //$this->config = $config;
        self::$db = new $config['db']['class']($config['db']['config']);
        
        self::$view = new  $config['view']['class']();
    }
    
    function run(){
        
        $url = $this->getUrl();
        
        //$list = self::$db->select("select * from article");
        
        pr($list);
        
        pr($url,'Hello word!');
        
        self::$view->render('modules/articles/views/test.tpl');
        
    }
    
    function getUrl(){
        return explode("/",$_REQUEST['path']);
    }
}
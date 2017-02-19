<?php

namespace core;

class Core{
    
    static $DataBase;
    static $view;
    static $app;
    
    public $css;
    
    function __construct($config){
        
        $this->actions = $config['actions'];
        
        unset($config['actions']);
        
        $this->config = $config;
        
        self::$app = $this;
        
        $this->css = $config['css'];
    }
    
    function run(){
        
        $url = $this->getUrl();
        
        //$list = self::$db->select("select * from article");
        
        if($this->actions[$url[0]]){
            $act = $this->actions[$url[0]];
            $class = new $act[0]();
            $class->{$act[1]}($url);
            die();
        }
        
        //pr('list',$list);
        
        //pr('fetch',$list->fetch_assoc());
        
        //pr($url,'Hello word!');
        
        //self::$view->render('modules/articles/views/test.tpl');
        
    }
    
    function getUrl(){
        return explode("/",$_REQUEST['path']);
    }
    
    function db(){
        if(!self::$DataBase){
            self::$DataBase = new $this->config['db']['class']($this->config['db']['config']);
        }
        return self::$DataBase;
    }
    
    function render($tpl,$args=null){
        if(!self::$view){
            self::$view = new $this->config['view']['class']();
        }
        return self::$view->render($tpl,$args);
    }
    
    function getCss(){
        return $this->css;
    }
}
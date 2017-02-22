<?php

namespace core;

class Core{
    
    static $DataBase;
    static $view;
    static $app;
    
    public $css;
    public $module;
    
    function __construct($config){
        
        $this->actions = $config['actions'];
        
        unset($config['actions']);
        
        $this->config = $config;
        
        self::$app = $this;
        
        $this->css = $config['css'];
        $this->js = $config['js'];
        
        $this->module = new controllers\Modules($config['modules']);
        
    }
    
    function run()
    {
        
        $url = $this->getUrl();
        
        if($this->actions[$url[0]]){
            
            if($url[0] != 'content'){
                $this->module->user->startSession();
            }
            
            $act = $this->actions[$url[0]];
            if(is_array($act)){
                $class = new $act[0]($this->config['modules'][$act[2]]);
                $class->{$act[1]}($url);
            }else{
                $this->$act($url);
            }
            die();
            
        }else{
            $this->module->user->startSession();
        }
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
    
    function getJs(){
        return $this->js;
    }
    
    function ajax($url){
        $module = $url[1];
        $action = "ajax".mb_convert_case($url[2], MB_CASE_TITLE, "UTF-8");
        
        if(method_exists($this->module->$module, $action)){
            $res = $this->module->$module->$action($_REQUEST['send']);
        }else{
            $res = ['error'=>'method not exist'];
        }
        
        if($res){
            echo "<ja>" . json_encode($res) . "</ja>";
        }
    }
    
    function module($url){
        $module = $url[1];
        $action = "action".mb_convert_case($url[2], MB_CASE_TITLE, "UTF-8");
        
        if(method_exists($this->module->$module, $action)){
            $this->module->$module->$action($url,$send);
        }else{
            $this->error404();
        }
    }
    
    function error404(){
        echo "Нет такой страницы";
    }
}
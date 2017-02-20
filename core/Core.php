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
            
            if($url[0] != 'content'){
                session_start();
            }
            
            $act = $this->actions[$url[0]];
            if(is_array($act)){
                $class = new $act[0]();
                $class->{$act[1]}($url);
            }else{
                $this->$act($url);
            }
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
    
    function ajax($url){
        $module = $url[1];
        $controller = mb_convert_case($module, MB_CASE_TITLE, "UTF-8");
        $name = "\\modules\\$module\Controller{$controller}";
        $model = new $name();
        $action = "ajax".mb_convert_case($url[2], MB_CASE_TITLE, "UTF-8");
        
        if(method_exists($model, $action)){
            $res = $model->$action($_REQUEST['send']);
        }else{
            $res = ['error'=>'method not exist'];
        }
        
        if($res){
            echo "<ja>" . json_encode($res) . "</ja>";
        }
    }
    
    function module($url){
        $module = $url[1];
        $controller = mb_convert_case($module, MB_CASE_TITLE, "UTF-8");
        $name = "\\modules\\$module\Controller{$controller}";
        $model = new $name();
        $action = "action".mb_convert_case($url[2], MB_CASE_TITLE, "UTF-8");
        
        if(method_exists($model, $action)){
            $model->$action($url,$send);
        }else{
            //echo 404
        }
    }
}
<?php

namespace core;

class Core{
    
    static $DataBase;
    static $view;
    static $app;
    
    public $css;
    public $js;
    public $module;
    
    function __construct($config)
    {
        
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
        
        if($url[0] != 'content'){
            $this->module->user->startSession();
        }
        
        if($this->actions[$url[0]]){
            $act = $this->actions[$url[0]];
            if(is_array($act)){
                $set = (isset($act[2]) && isset($this->config['modules'][$act[2]])) ? $this->config['modules'][$act[2]] : null;
                $class = new $act[0]($set);
                $class->{$act[1]}($url);
            }else{
                $this->$act($url);
            }
            die();
        }else{
           $stat = $this->module->page->actionPage($url,$_GET);
           if($stat === 404){
               $this->error404();
           }
        }
    }
    
    
    function getUrl()
    {
        return explode("/",$_REQUEST['path']);
    }
    
    function db()
    {
        if(!self::$DataBase){
            self::$DataBase = new $this->config['db']['class']($this->config['db']['config']);
        }
        return self::$DataBase;
    }
    
    function render($tpl,$args=null)
    {
        if(!self::$view){
            self::$view = new $this->config['view']['class']();
        }
        return self::$view->render($tpl,$args);
    }
    
    function getCss()
    {
        $this->initModules();
        return $this->css;
    }
    
    function getJs()
    {
        $this->initModules();
        return $this->js;
    }
    
    function ajax($url)
    {
        $module = $url[1];
        $action = "ajax".mb_convert_case($url[2], MB_CASE_TITLE, "UTF-8");
        
        if(method_exists($this->module->$module, $action)){
            $res = $this->module->$module->$action($_REQUEST['send'],$_REQUEST);
        }else{
            $res = ['error'=>"method $action not exist"];
        }
        
        if($res){
            echo "<ja>" . json_encode($res) . "</ja>";
        }
    }
    
    function module($url)
    {
        $module = $url[1];
        $action = "action".mb_convert_case($url[2], MB_CASE_TITLE, "UTF-8");
        
        if(method_exists($this->module->$module, $action)){
            $this->module->$module->$action($url,$send);
        }else{
            $this->error404();
        }
    }
    
    function error404()
    {
        echo "Нет такой страницы";
    }
    
    public $modulesIsInit = 0;
    
    function initModules()
    {
        if($this->modulesIsInit == 0){
            $this->modulesIsInit = 1;
            foreach($this->config['modules'] as $module=>$conf){
                $this->registerResource(APP_DIR . "/custom/".$module."/composer.php");
                $this->registerResource(APP_DIR . "/modules/".$module."/composer.php");
            }
        }
    }
    
    function registerResource($file) {
        if (file_exists($file)) {
            $set = include $file;
            if(is_array($set['source'])){
                foreach ($set['source'] as $key => $param) {
                    foreach ($param as $type => $list) {
                        foreach ($list as $name => $it) {
                            if (is_string($name)) {
                                $this->{$type}[$key][$name] = $it;
                            } else {
                                $this->{$type}[$key][] = $it;
                            }
                        }
                    }
                }
            }
        }
    }

    function getVersion()
    {
        return $this->config['version'];
    }
    
    function getStruct($active=1,$full=0)
    {
        return $this->db()->select("select *,id as ARRAY_KEY,parent as PARENT_KEY from struct where alias !='_default' && active=$active");
    }
}
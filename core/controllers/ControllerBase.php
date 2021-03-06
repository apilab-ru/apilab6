<?php

namespace core\controllers;

abstract class ControllerBase
{
    function render($name,$arg=null)
    {
        
        $class = explode("\\",get_class($this));
        
        if(is_array($name)){
            
            $type = $name[0];
            switch($type){
                case 'custom':
                    $tpl = 'custom/'.$class[1] ."/".$name[1].".tpl";
                    break;
            }
            
        }else{
            //Шаблон в модуле
            unset( $class[count($class)-1] );
            $dir = implode("/",$class) . "/view/" ;
            
            $tpl = $dir.$name.".tpl";
        }
        
        return \core\Core::$app->render($tpl,$arg);
    }
    
    function admin($act,$param=null)
    {
        $actions = $this->getAdminActions();
        
        $method = "admin".$act;
        ob_start();
        
        $res = $this->$method($param);
        
        $res['title'] = $res['module'] = $actions['name'];
        
        $res['description'] = $actions['description'];
        
        if($actions['list'] && $actions['list'][$act]){
            $res['title'] = $res['action'] = $actions['list'][$act]['name'];
            $res['description'] = $actions['list'][$act]['description'];
        }
        
        $res['content'] = ob_get_clean();
        
        return $res;
    }
    
    
    function adminAjax($action,$param)
    {
        $method = "adminAjax".$action;
        if(method_exists($this, $method)){
            return $this->$method($param);
        }else{
            return ['error'=>"method $method not exist"];
        }
    }
    
    function ext($data,$param){
        if($param){
            foreach($param as $key=>$it){
                if(!$data[$key]){
                    $data[$key] = $it;
                }
            }
        }
        return $data;
    }
    
    function __call($name,$argumnets)
    {
        return "Метод $name не найден";
    }
    
    function block($act,$block,$config,$pages)
    {
        if(method_exists($this, 'block'.$act)){
            ob_start();
            $res = $this->{'block'.$act}($block,$config,$pages);
            if($res['tpl']){
                $tpl = $res['tpl'];
            }else{
                $tpl = $block['tpl'];
            }
            if($res['title']){
                \core\Core::$app->module->page->setTitle($res['title']);
            }
            $res['data']['block'] = $block;
            echo $this->render($tpl,$res['data']);
            return ob_get_clean();
        }
    }
    
    function blockConfig($act)
    {
        if(method_exists($this, 'blockConfig'.$act)){
            return $this->{'blockConfig'.$act}();
        }
    }
    
    function getNameAction($act)
    {
        return $this->actions[$act]['name'];
    }
    
    function getNameModule()
    {
        if(method_exists($this, 'getAdminActions')){
            return $this->getAdminActions()['name'];
        }else{
            return null;
        }
    }
    
}
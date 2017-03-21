<?php

namespace modules\admin;

class Controller extends \core\controllers\ControllerBase
{
    
    function __construct() {
        $this->model = new Model();
    }
    
    function actionIndex($url)
    {
        $user = $_SESSION['user'];
        $user['role'] = 'Администратор';
        
        if(!$_SESSION['user']){
            header("Location: /in/?from=/admin/");
            die();
        }
        
        $param = json_decode($_REQUEST['param'],1);
        
        $content = $this->getContent($url[1],$url[2],$param);
        
        echo $this->render('index',[
            'user' => $user,
            'version'=>$this->model->core->getVersion(),
            'content'=>$content,
            'modulesActions'=>$this->model->getModulesActions($url[1],$url[2])
        ]);
    }
    
    function getContent($module=null,$action=null,$param=null,$prev=null)
    {
        if($module && $action){
            $content = $this->model->core->module->$module->admin($action,$param);
            if($prev){
                $content['prev'] = $prev;
            }
        }
        
        return $this->render("content",$content);
    }
    
    function ajaxGetContent($send)
    {
        echo $this->getContent($send['module'],$send['action'],$send['param'],$send['prev']);
    }
    
    function ajaxModule($send)
    {
        $module = $send['module'];
        return $this->model->core->module->$module->adminAjax($send['action'],$send['param'],$send['param']);
    }
    
    function ajaxTranslete($send)
    {
        $res = \core\utils\Translete::run($send['word']);
        return ['res'=>$res];
    }
    
}

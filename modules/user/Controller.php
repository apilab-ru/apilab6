<?php

namespace modules\user;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    function __construct($set) {
        $this->set = $set;
        $this->model = new Model();
    }
    
    function startSession(){
        session_start();
        if($_COOKIE['PHPSESSID'] && !$_COOKIE['apilabuser']){
            setcookie('apilabuser',$_COOKIE['PHPSESSID'],time()+60*60*24*30);
        }else{
            $user = $this->model->getUserCookie($_COOKIE['apilabuser']);
            if($user){
                $this->model->auth($user,1,$_COOKIE['apilabuser']);
            }
        }
    }
    
    function ajaxAuthVk($send){
        $vk = new \core\api\vk();
        $userVk = $vk->authByWindget($send);
            
        $user = $this->model->getUserVk($userVk['vk_id']);
        if($user){
            $this->model->auth($user);
            return ['action'=>'auth'];
        }else{
            $_SESSION['tmp_user'] = $userVk;
            return ['action'=>'register'];
        }
    }
    
    function actionAuth($send){
        
        if($_SESSION['user']){
            echo $this->render('profile',$_SESSION['user']);
        }else{
            
            $from = ($_REQUEST['from']) ? $_REQUEST['from'] : "/";
            
            echo $this->render('auth',[
                'vkapid'=>$this->set['vkapid'],
                'from' => $from
            ]);
        }
    }
    
    function ajaxAuth($send){
        $user = $this->model->getUser($send['login'],$send['password']);
        if($user){
            $this->model->auth($user,$send['remember'],$_COOKIE['apilabuser']);
            return [
                'stat'=>1
            ];
        }else{
            return array('error'=>'Некорректный логин / Пароль');
        }
    }
    
    function actionOut($url){
        session_destroy();
        $_COOKIE['apilabuser'] = null;
        header("Location: /");
    }
    
    function actionRegisterUser($send=null){
        pr($_SESSION['tmp_user']);
        pr('reg user',$send);
    }
    
    
    function getAdminActions(){
        
        return [
            "act"=>"list",
            "name"=>"Пользователи",
            "icon"=>"admin-icon-users",
            "description"=>'Управление пользователями сайта'
        ];
        
    }
    
    function adminList($send){
        $list = $this->model->getList();
        echo $this->render("admin/list",[
            'list'=>$list
        ]);
    }
    
}


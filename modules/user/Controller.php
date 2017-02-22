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
            echo $this->render('auth',[
                'vkapid'=>$this->set['vkapid']
            ]);
        }
    }
    
    function ajaxAuth($send){
        $user = $this->model->getUser($send['login'],$send['password']);
        if($user){
            return array(
                'stat'=>1,
                'cookie'=>$this->model->auth($user,$send['remember'])
            );
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
    
}


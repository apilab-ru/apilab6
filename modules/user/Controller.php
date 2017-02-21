<?php

namespace modules\user;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    function __construct() {
        $this->model = new Model();
    }
    
    function startSession(){
        session_start();
        //pr($_COOKIE);
    }
    
    function actionAuth(){
        //pr($_COOKIE);
        if($_SESSION['user']){
            echo $this->render('profile',$_SESSION['user']);
        }else{
            echo $this->render('auth');
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
        header("Location: /");
    }
}


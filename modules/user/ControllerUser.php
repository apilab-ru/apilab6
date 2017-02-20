<?php

namespace modules\user;
use core\controllers\ControllerBase;

class ControllerUser extends ControllerBase{
    
    function __construct() {
        $this->model = new ModelUser();
    }
    
    function actionAuth(){
        
        if($_SESSION['user']){
            //pr($_SESSION);
            echo $this->render('profile',$_SESSION['user']);
        }else{
            echo $this->render('auth');
        }
    }
    
    function ajaxAuth($send){
        $user = $this->model->getUser($send['login'],$send['password']);
        if($user){
            $this->model->auth($user);
            return array('stat'=>1);
        }else{
            return array('error'=>'Некорректный логин / Пароль');
        }
    }
    
    function actionOut($url){
        session_destroy();
        header("Location: /");
    }
}


<?php

namespace modules\user;
use core\controllers\ControllerBase;

class ControllerUser extends ControllerBase{
    
    function actionAuth(){
        echo $this->render('auth');
    }
    
}


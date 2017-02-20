<?php

namespace modules\user;

class ModelUser extends \core\models\ModelBase{
    
    function getUser($login,$pass){
        $this->db->setLogger(1);
        return $this->db->selectRow("select * from user where mail=? && pass=?",$login,md5($pass));
    }
    
    function auth($user){
        session_start();
        $_SESSION['user'] = $user;
    }
    
}

<?php

namespace modules\user;

class Model extends \core\models\ModelBase{
    
    function getUser($login,$pass){
        return $this->db->selectRow("select * from user where mail=? && pass=?",$login,md5($pass));
    }
    
    function auth($user,$remember=0){
        session_start();
        if($remember){
            $cookie = md5( $user['email'] . $user['id'] . time() . "apilab" );
            $this->updateUser($user['id'],['cookie'=>$cookie]);
        }
        $_SESSION['user'] = $user;
        return $cookie;
    }
    
    function updateUser($id,$arr){
        $this->db->query("UPDATE `user` set ?a where id=?d",$arr,$id);
    }
    
    function getUserVk($vkId){
        return $this->db->selectRow("select * from `user` where vk_id =?d",$vkId);
    }
}

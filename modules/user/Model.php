<?php

namespace modules\user;

class Model extends \core\models\ModelBase
{
    
    function getUser($login,$pass)
    {
        return $this->db->selectRow("select * from user where mail=? && pass=?",$login,md5($pass));
    }
    
    function getUserCookie($cookie)
    {
        return $this->db->selectRow("select * from user where cookie=?",$cookie);
    }
    
    function auth($user,$remember=0,$cookie)
    {
        if($remember){
            $this->updateUser($user['id'],['cookie'=>$cookie]);
        }
        $_SESSION['user'] = $user;
        return $cookie;
    }
    
    function updateUser($id,$arr)
    {
        $this->db->query("UPDATE `user` set ?a where id=?d",$arr,$id);
    }
    
    function getUserVk($vkId)
    {
        return $this->db->selectRow("select * from `user` where vk_id =?d",$vkId);
    }
    
    function getList()
    {
        return $this->db->select("select *,id as ARRAY_KEY from user order by id DESC");
    }
}

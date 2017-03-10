<?php

namespace modules\log;

class Model extends \core\models\ModelBase
{
    function getList()
    {
        $list = $this->db->select("select * from log order by id DESC limit 50");
        return array('list'=>$list);
    }
    
    function clearAll()
    {
        $this->db->query('TRUNCATE log');
    }
    
}

<?php

namespace modules\html;

class Model extends \core\models\ModelBase
{
    function getHtmlBlock($id)
    {
        return $this->db->selectRow("SELECT * FROM `html_blocks` where id=?d",$id);
    }
    
    function getListOptions()
    {
        return $this->db->selectCol("select id as ARRAY_KEY,name as ARRAY_VALUE from html_blocks order by id DESC");
    }
    
    function getList()
    {
        return $this->db->select("select * from html_blocks order by id DESC");
    }
    
    function saveHtmlBlock($block,&$id=0)
    {
        if($id){
            return $this->db->update('html_blocks',$block,$id);
        }else{
            $block['author'] = $_SESSION['user']['id'];
            $id = $this->db->insert('html_blocks',$block);
            return 1;
        }
    }
}

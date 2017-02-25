<?php

namespace modules\article;

class Model extends \core\models\ModelBase
{
    
    function __construct($param=array()) {
        parent::__construct();
        $this->filter = $param;
    }
    
    function getListArticle($filter){
        
        $filter = $this->extendFilter($filter,$this->filter);
        
        $page = ($filter['page']) ? $filter['page'] : 1;
        
        $select = [
            "a.*",
            "s.name as struct_name"
        ];
        
        $from = [
            "article as a"
        ];
        
        $leftJoin = [
            "struct as s on s.id = a.struct_id"
        ];
        
        $where = [];
        
        if($filter['struct']){
            $where[] = " a.struct_id = " . (int)$filter['struct'];
        }
        
        if(isset($filter['publish'])){
            $where[] = " a.publish = " . (int)$filter['publish'];
        }
        
        $limit = (($page-1) * $filter['limit']) . ",".$filter['limit'];
        
        $sql = "select SQL_CALC_FOUND_ROWS ".implode(",",$select)
                ." from ".implode(",",$from)
                ." left join " . implode(",",$leftJoin);
        
        if($where){
            $sql .= " where ".implode(" && ",$where);
        }
        
        $sql .= " limit $limit";
        
        $list = $this->db->select($sql);
        
        return [
            'list'=>$list,
            'page'=>$page,
            'count'=>$this->db->selectCell("SELECT FOUND_ROWS()"),
            'limit'=>$filter['limit']
        ];
        
    }
    
    function getArticle($id){
        $art = $this->db->selectRow("select * from article where id=?d",$id);
        return $art;
    }
}
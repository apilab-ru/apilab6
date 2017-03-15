<?php

namespace modules\article;

class Model extends \core\models\ModelBase
{
    
    function __construct($param=array()) 
    {
        parent::__construct();
        $this->filter = $param;
    }
    
    function getListArticle($filter)
    {
        
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
        
        $sql .= " order by id DESC limit $limit";
        
        $list = $this->db->select($sql);
        
        return [
            'list'=>$list,
            'page'=>$page,
            'count'=>$this->db->selectCell("SELECT FOUND_ROWS()"),
            'limit'=>$filter['limit']
        ];
        
    }
    
    function getArticle($id)
    {
        $art = $this->db->selectRow("select * from article where id=?d",$id);
        $art['image'] = $this->db->selectRow("select * from images where id=?d",$art['img_id']);
        $art['tags'] = \core\Core::$app->module->tags->getTagsObject('article',$id);
        return $art;
    }
    
    function saveArticle($art,&$id,&$error)
    {
        if($art['date_start']){
           $art['date_start'] = date('Y-m-d H:i:s',strtotime(art['date_start'])); 
        }
        if($id){
            $stat = $this->db->query('UPDATE article set ?a where id=?d',$art,$id);
        }else{
            $id = $this->db->insert('article',$art);
            if($id){
                $stat = 1;
            }
        }
        if(!$stat){
            $error = $this->db->getError();
            if(!$error && $id){
                $stat = 1;
            }
        }
        return $stat;
    }
    
    function getLastArticleByStruct($struct)
    {
        $art = $this->db->selectRow('select * from article where struct_id=?d && active=1 order by id DESC', $struct);
        $art['image'] = $this->db->selectRow("select * from images where id=?d",$art['img_id']);
        $art['tags'] = \core\Core::$app->module->tags->getTagsObject('article',$art['id']);
        return $art;
    }
}
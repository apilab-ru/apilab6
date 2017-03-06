<?php

namespace modules\files;

class Model extends \core\models\ModelBase
{
    
    function __construct($param=array()) 
    {
        parent::__construct();
        $param['page'] = 1;
        $this->filter = $param;
        
        $this->imageDir = $_SERVER['DOCUMENT_ROOT'].'/content/images_orig/';
    }
    
    function getImage($id)
    {
        return $this->db->selectRow("select * from images where id=?d",$id);
    }
    
    function getFiles($data)
    {
        $list = [];
        foreach($data as $key=>$arr){
            foreach($arr as $num=>$val){
                $list[$num][$key] = $val;
            }
        }
        return $list;
    }
    
    function getListImages($param)
    {
        $filter = $this->extendFilter($param);
        
        $select = [
            'img.*'
        ];
        
        $from = [
            'images as img',
        ];
        
        $where = [];
        
        if($param['struct']){
            $where[] = "struct_id=".$param['struct'];
        }
        
        $limit = " limit ".(($filter['page'] - 1)*$filter['limit']).",".$filter['limit'];    
        
        $sql = "select SQL_CALC_FOUND_ROWS ".implode(",",$select)
                ." from ".implode(',',$from);
        
        if($where){
            $sql .= " where " . implode(" && ",$where);
        }
         
        $sql.= " order by id DESC " . $limit;
        
        $list = $this->db->select($sql);
        
        $count = $this->db->selectCell("SELECT FOUND_ROWS()");
        
        return [
            'list'=>$list,
            'count'=>$count,
            'limit'=>$filter['limit'],
            'page'=>$filter['page']
        ];
    }
    
    function getImgType($file)
    {
        $list = explode("/",$file['type']);
        $type = mb_strtolower($list[count($list)-1]);
        return $type;
    }
    
    function saveImage($file,$id)
    {
        $destination = $this->imageDir . $id.".".$file['type'];
        return copy($file['tmp_name'], $destination);
    }
    
    function addImage($name,$type,$structId=0,$descripton='')
    {
        return $this->db->insert('images',[
            'name'=>$name,
            'type'=>$type,
            'struct_id'=>$structId,
            'descr'=>$descripton,
            'author'=>$_SESSION['user']['id']
        ]);
    }
    
    function removeFile($id)
    {
        $this->db->query('delete from images where id=?d',$id);
    }
    
}
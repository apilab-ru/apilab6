<?php

namespace modules\page;

class Model extends \core\models\ModelBase
{
    function getPage($url)
    {
        $page = array();
        $parent = 0;
        $stat = 1;
        if(count($url)>1 && $url[count($url)-1]==''){
            unset($url[count($url)-1]);
        }
        foreach($url as $item){
            $page[] = $this->getPageforAlias($item,$parent,$stat);
            if(!$stat){
                return false;
            }
        }
        return array_reverse($page);
    }
    
    function getPageforAlias($alias,&$parent,&$stat)
    {
        $page = $this->db->selectRow("select s.*,src as tpl from struct as s,theme as t where t.id=s.theme && alias=? && parent=?d",$alias,$parent);
        if(!$page && $parent==0){
            $page = $this->db->selectRow("select s.*,src as tpl from struct as s,theme as t where t.id=s.theme && alias=? && parent=2",$alias,$parent);
        }
        if(!$page){
            $stat = 0;
        }else{
            $parent = $page['id'];
        }
        return $page;
    }
    
    function getBlocks($pages,$grouping)
    {
        $blocks = $this->db->select('select * from blocks where parent_id=?d && `group`!=0 && active=1 order by weight ASC', $pages[0]['id']);
        if(!$blocks){
           $blocks = $this->_getBlocks($pages,1); 
        }
        $module = $this->db->select('select * from blocks where parent_id=?d && `group` = 0 && active=1 order by weight ASC', $pages[0]['id']);
        if ($grouping) {
            $blocks = $this->groupBy('group', $blocks);
        }
        if ($module) {
            $blocks[0] = $module;
        }
        return $blocks;
    }
    
    function _getBlocks($tree,$num)
    {
        $default = $this->db->selectCell('select id from struct where parent=?d && alias="_default"',$tree[$num-1]['parent']);
        if($default){
            return $this->db->select('select *,"1" as is_default from blocks where parent_id=?d && active=1 order by weight ASC',$default);
        }else{
            $num++;
            if(count($tree)-1>=$num){
               // $blocks = db::select('select * from blocks where parent_id=?d && active=1 order by weight ASC', $tree[count($tree) - $num]['id']);
                if(!$blocks){
                    $blocks = $this->_getBlocks($tree,$num);
                }
                return $blocks;
            }
        }
    }
    
    function groupBy($by, $list) 
    {
        $mas = array();
        if ($list)
            foreach ($list as $item) {
                $mas[$item[$by]][] = $item;
            }
        return $mas;
    }
}

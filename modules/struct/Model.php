<?php

namespace modules\struct;

class Model extends \core\models\ModelBase
{
    function getStructList($page)
    {
        $list = \core\Core::$app->getStruct();
        $list = $this->findStruct($list,$page['id']);
        return $list;
    }
    
    function findStruct($list,$struct,&$check=0)
    {
        foreach($list as $key=>$item){
            if($item['id']==$struct){
                $list[$key]['check'] = 1;
                $check = 1;
            }elseif($item['childNodes']){
                $check = 0;
                $list[$key]['childNodes'] = $this->findStruct($item['childNodes'],$struct,$check);
                if($check){
                    $list[$key]['check'] = 1;
                }
            }
        }
        return $list;
    }
    
    function getBlock($id)
    {
        return $this->db->selectRow('select * from blocks where id=?d',$id);
    }
    
    function getModules()
    {
        $list = $this->core->module->getList();
        $data = [];
        foreach($list as $key=>$set){
            $name = $this->core->module->$key->getNameModule();
            if($name){
                if($this->core->module->$key->actions){
                    $data[$key] = [
                        'name'=>$name,
                        'actions'=>$this->core->module->$key->actions
                    ];
                }
            }
        }
        return $data;
    }
    
    function getTemplates()
    {
        return [
            'templates'=>$this->core->templates,
            'templateToBlock'=>$this->core->templateToBlock
        ];
    }
    
    function getPageById($id)
    {
        return $this->db->selectRow("select * from struct where id=?d",$id);
    }
    
    function updatePage($groups,$page)
    {
        $modules = $groups[0];
        
        $this->db->setLogger();
        
        $updates = array();
        unset($groups[0]);
        foreach($modules as $item){
            $item['parent_id'] = $page;
            $updates[] = $this->saveBlock($item);
        }
        $this->db->query('delete from blocks where parent_id=?d && id not in(?a) && `group`=0',$page,$updates);
        
        $updates = array();
        foreach ($groups as $gr => $items) {
            foreach ($items as $item) {
                $item['parent_id'] = $page;
                $updates[] = $this->saveBlock($item);
            }
        }
        $this->db->query('delete from blocks where parent_id=?d && id not in(?a) && `group`!=0',$page,$updates);
        return 1;
    }
    
    function saveBlock($item) {
        if($item['config'] && is_array($item['config'])){
            $item['config'] = json_encode($item['config']);
        }
        if ($item['id']) {
            $id = $item['id'];
            unset($item['id']);
            $this->db->update('blocks', $item, $id);
            return $id;
        } else {
            unset($item['id']);
            return $this->db->insert('blocks', $item);
        }
    }

}

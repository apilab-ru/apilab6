<?php

namespace modules\admin;

class Model extends \core\models\ModelBase
{
    
    function getModulesActions($url1=null,$url2=null)
    {
        $data = array();
        
        foreach(array_keys($this->core->config['modules']) as $module){
            if(method_exists($this->core->module->$module, 'getAdminActions')){
                $data[$module] = $this->core->module->$module->getAdminActions();
            }
        }
        
       foreach($data as $key=>$it){
           if($key==$url1){
               $data[$key]['check'] = 1;
               if($it['list']){
                   foreach($it['list'] as $key2=>$it2){
                       if($key2==$url2){
                           $data[$key]['list'][$key2]['check'] = 1;
                       }
                   }
               }
           }
       }
       
       return $data;
    }
    
}


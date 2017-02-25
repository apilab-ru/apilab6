<?php

namespace modules\admin;

class Model extends \core\models\ModelBase
{
    
    function getModulesActions()
    {
        $data = array();
        
        foreach(array_keys($this->core->config['modules']) as $module){
            if(method_exists($this->core->module->$module, 'getAdminActions')){
                $data[$module] = $this->core->module->$module->getAdminActions();
            }
        }
        
        return $data;
    }
    
}


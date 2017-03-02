<?php

namespace modules\files;

class Model extends \core\models\ModelBase
{
    
    function __construct($param=array()) {
        parent::__construct();
        $this->filter = $param;
    }
    
}
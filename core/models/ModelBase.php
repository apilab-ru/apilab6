<?php

namespace core\models;

class ModelBase {
    
    function __construct() {
        $this->db = \core\Core::$app->db();
        $this->core = \core\Core::$app;
    }
    
}

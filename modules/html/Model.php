<?php

namespace modules\html;

class Model extends \core\models\ModelBase
{
    function getHtmlBlock($id)
    {
        return $this->db->selectRow("SELECT * FROM `html_blocks` where id=?d",$id);
    }
}

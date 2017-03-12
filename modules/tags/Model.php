<?php

namespace modules\tags;

class Model extends \core\models\ModelBase
{
    function getTagsObject($object,$id){
        return $this->db->select("select t.name,t.id from tag as t,tags "
                . "where t.id = tags.tag_id && tags.object=? && tags.element_id=?d ",$object,$id);
    }
}

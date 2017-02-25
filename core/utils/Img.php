<?php

namespace core\utils;

/**
 * Description of img
 *
 * @author Dekim
 */
class Img 
{
    
    static function widget($params)
    {
        return "/content/images/{$params['id']}_{$params['tpl']}.{$params['type']}";
    }
    
}

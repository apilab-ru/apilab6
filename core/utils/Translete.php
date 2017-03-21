<?php

namespace core\utils;

class Translete {
    
    static $instanse = null;
    
    static function run($word,$url=1)
    {
        if(!self::$instanse){
            self::$instanse =  new self();
        }
        return  self::$instanse->toTranslete($word,$url);
    }
    
    function __construct() 
    {
        $this->api = new \core\api\yandexTranslete();
    }
    
    function toTranslete($word,$url)
    {
        $word = $this->api->translete($word);
        if($word){
            if($url){
                $word = strtolower(str_replace([' ','-','.',','],'_',$word));
                
            }
            return $word;
        }
    }
}

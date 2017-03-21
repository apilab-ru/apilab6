<?php

namespace core\api;

class yandexTranslete
{
    function __construct() 
    {
        $this->key = 'trnsl.1.1.20170321T152553Z.4313a61f4cfa2cb4.6a03412ed683532f63bbba9bbf7224ed313df72f';
    }
    
    function translete($word)
    {
        $param = [
            'key'=>$this->key,
            'text'=>$word,
            'lang'=>'ru-en'
        ];
        
        $res = file_get_contents("https://translate.yandex.net/api/v1.5/tr.json/translate?".http_build_query($param));
        $res = json_decode($res,1);
        
        if($res['code']==200){
            return $res['text'][0];
        }
    }
}
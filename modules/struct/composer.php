<?php

return [
    'templates'=>[
        "botstrap"=>'Верхнее botstrap',
        "top"=>'Верхнее настраиваемое'
    ],
    'templateToBlock'=>[
        "menu"=>['botstrap','top'],
    ],
    "source"=>[
       "admin"=>[
           "js"=>['/modules/struct/struct.js'],
           "css"=>['/modules/struct/struct.css']
       ]
    ]
];

<?php

return [
    'templates'=>[
        "main"=>'Главная статья',
        "list"=>'Список статьей'
    ],
    'templateToBlock'=>[
        "main"=>['main'],
        "list"=>['list']
    ],
    "source"=>[
        "admin"=>[
            "js"=>['/modules/article/article.js'],
            "css"=>['/modules/article/style.css']
        ]
    ]
];

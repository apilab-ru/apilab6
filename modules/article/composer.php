<?php

return [
    'templates'=>[
        "main"=>'Главная статья',
        "list"=>'Список статьей',
        "bootstrapList"=>"Список новостей bootstrap",
        "bootstrapItem"=>"Статья bootstrap"
    ],
    'templateToBlock'=>[
        "main"=>['main'],
        "list"=>['list','bootstrapList'],
        "item"=>["bootstrapItem"]
    ],
    "source"=>[
        "admin"=>[
            "js"=>['/modules/article/article.js'],
            "css"=>['/modules/article/style.css']
        ]
    ]
];

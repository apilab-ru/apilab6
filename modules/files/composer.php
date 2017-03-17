<?php

return [
    'templates'=>[
        "listFiles"=>'Список файлов',
        "listImages"=>'Галаерея картинок'
    ],
    'templateToBlock'=>[
        "listFiles"=>['listFiles'],
        'listImages'=>['listImages']
    ],
    "source"=>[
        "admin"=>[
            "js"=>['/modules/files/files.js'],
            "css"=>["/modules/files/files.css"]
        ],
        "add"=>[
            "css"=>['/modules/files/base.css']
        ]
    ]
];

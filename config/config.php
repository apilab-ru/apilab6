<?php
return [
    "db"=>[
        "class" => "core\utils\DataBase",
        "config"=> include 'database.php'
    ],
    "view"=>[
        "class" => "core\utils\View"
    ],
    "actions"=>[
        "content"=>["core\utils\Files","actionGet"],
        "admin"  =>["modules\admin\Controller","actionIndex",'admin'],
        "in" =>["modules\user\Controller","actionAuth",'user'],
        "ajax"=>"ajax",
        "module"=>"module"
    ],
    "css"=>[
        "core" => include './core/css.php',
        "add"  => include 'css.php'
    ],
    "js"=>[
        "core" => include './core/js.php',
        "add"  => include 'js.php'
    ],
    "modules"=>[
        "user"=>[
            "vkapid"=>'3729990'
        ],
        "admin"=>[],
        "article"=>[
            "limit"=>10
        ],
        'files'=>[
            "limit"=>20,
            "struct"=>0
        ],
        "log"=>[],
        "tags"=>[]
    ],
    "version"=>"6.0.1"
];
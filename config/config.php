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
        "admin"  =>["modules\admin\Controller","route"],
        "in" =>["modules\user\Controller","actionAuth"],
        "ajax"=>"ajax",
        "module"=>"module"
    ],
    "css"=>[
        "core" => include './core/css.php',
        "add"  => include 'css.php'
    ]
];
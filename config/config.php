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
        "admin"  =>["modules\admin","route"],
        "in" =>["modules\user\ControllerUser","actionAuth"]
    ],
    "css"=>[
        "core" => include './core/css.php',
        "add"  => include 'css.php'
    ]
];
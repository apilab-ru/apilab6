<?php
return [
    "db"=>[
        "class" => "core\utils\DataBase",
        "config"=> include 'database.php'
    ],
    "view"=>[
        "class" => "core\utils\View"
    ]
];
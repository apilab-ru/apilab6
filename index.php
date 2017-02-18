<?php
$config = include "config/config.php";

include "core/Application.php";
include "core/Utils.php";

include "core/autoloader.php";

(new core\Application($config))->run();
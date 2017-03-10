<?php
error_reporting(E_ALL & ~E_NOTICE);
$config = include "config/config.php";

define("APP_DIR", dirname(__FILE__));
define("DEVELOP", 1);

include "core/Core.php";
include "core/Utils.php";

include "core/autoloader.php";

(new core\Core($config))->run();
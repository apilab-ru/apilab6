<?php
error_reporting(0);
$config = include "config/config.php";

define("APP_DIR", dirname(__FILE__));
define("DEVELOP", 1);

include "core/Core.php";
include "core/Utils.php";

include "core/autoloader.php";

(new core\Core($config))->run();
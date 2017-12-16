<?php
const APP_NAMESPACE = 'app';

define('PROJECT_DIR', dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR);
define('APP_PATH', PROJECT_DIR . APP_NAMESPACE . DIRECTORY_SEPARATOR);

require PROJECT_DIR . 'thinkphp' . DIRECTORY_SEPARATOR . 'start.php';

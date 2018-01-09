<?php
/**
 * @copyright since 23:29 9/1/2018
 * @author <mc@dancis.info>
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
require '..' . DS . 'vendor' . DS . 'autoload.php';

use McDanci\std\JSON;

echo JSON::encode(['_debug' => 666]);

<?php
use McDanci\ThinkPHP\Config;
use think\Env;

return [
    DB_PREFIX => 'ss_',

    'charset' => 'utf8mb4',
    'debug' => (bool)Env::get('database.debug', Config::get('database.debug')),
    'sql_explain' => (bool)Env::get('database.sql_explain', Config::get('database.sql_explain')),
    'hostname' => Env::get('database.hostname', Config::get('database.hostname')),
    'database' => Env::get('database.username', Config::get('database.username')),
    'password' => Env::get('database.password', Config::get('database.password')),
];

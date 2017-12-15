<?php
use McDanci\ThinkPHP\Config;
use think\Env;

return [
    'charset' => 'utf8mb4',
    'hostname' => Env::get('database.hostname', Config::get('database.hostname')),
    'database' => Env::get('database.username', Config::get('database.username')),
    'password' => Env::get('database.password', Config::get('database.password')),
    'debug' => (bool)Env::get('database.debug', Config::get('database.debug')),
    'sql_explain' => (bool)Env::get('database.sql_explain', Config::get('database.sql_explain')),

    DB_PREFIX => 'ss_',
];

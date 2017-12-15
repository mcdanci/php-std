<?php
use McDanci\ThinkPHP\Config;
use think\Env;

/**
 * Configuration name.
 */
const
DB_USER = 'username',
DB_PASSWORD = 'password',
DB_NAME = 'database',
DB_PREFIX = 'prefix';

/**
 * @param $name
 * @return string
 */
function cn_db($name)
{
    return 'database.' . $name;
}

return [
    'charset' => 'utf8mb4',
    'hostname' => Env::get(cn_db('hostname'), Config::get(cn_db('hostname'))),
    DB_USER => Env::get(cn_db(DB_USER), Config::get(cn_db(DB_USER))),
    DB_PASSWORD => Env::get(cn_db(DB_PASSWORD), Config::get(cn_db(DB_PASSWORD))),
    DB_NAME => Env::get(cn_db(DB_NAME), Config::get(cn_db(DB_NAME))),
    'debug' => (bool)Env::get(cn_db('debug'), Config::get(cn_db('debug'))),
    'sql_explain' => (bool)Env::get(cn_db('sql_explain'), Config::get(cn_db('sql_explain'))),

    DB_PREFIX => 'ss_',
];

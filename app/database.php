<?php
use McDanci\ThinkPHP\Config;
use think\Env;

return [
    // TODO: development environment
    'debug' => true,
    'sql_explain' => true,

    //region development environment

    // TODO: Internet
    //'hostname' => '39.108.221.196',
    //'username' => 'sshow',
    //'password' => 'sshowadmin888',
    //'database' => 'sshowapi',

    //endregion

    //region Project

    //'prefix' => 'ss_reg_',
    'prefix' => 'ss_',

    //endregion

    //region Common

    'charset' => 'utf8mb4',

    //endregion

    //'database' => 'test',

    // TODO
    'database' => Env::get('database.username', 'root'),
    'password' => Env::get('database.password', Config::get('database.password')),
];

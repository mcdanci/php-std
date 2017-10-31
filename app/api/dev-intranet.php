<?php
/**
 * @copyright since 9:17 28/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */

$confDB = [
    'hostname' => 'develop-1.fmnii.e13.cc', // TODO: for dev
    'username' => 's-show',
    'password' => 'bqqcvALY6sE3Xc5j',
    'database' => 's-show',
];

return [
    'database' => array_merge(\think\Config::get('database'), $confDB),
];

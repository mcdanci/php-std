<?php
/**
 * @copyright since 14:48 2/11/2017
 * @author <mcdanci@users.noreply.github.com>
 */
return [
    'database' => array_merge(\think\Config::get('database'), [
        'hostname' => '127.0.0.1',
        'username' => 'sshow',
        'password' => 'guigusshow',
        'database' => 'sshow_part2',
    ]),
];

<?php
/**
 * @copyright since 11:18 7/12/2017
 * @author <mcdanci@users.noreply.github.com>
 */

//foreach ([
//             'AUTH_TYPE_REAL_TIME' => 1,
//             'AUTH_TYPE_ON_SIGNING' => 2,
//         ] as $constName => &$constVal) {
//    defined($constName) || define($constName, $constVal);
//}
defined('AUTH_TYPE_REAL_TIME') || define('AUTH_TYPE_REAL_TIME', 1);
defined('AUTH_TYPE_ON_SIGNING') || define('AUTH_TYPE_ON_SIGNING', 2);

$databasePrefix = \McDanci\ThinkPHP\Config::get('database.prefix') ?: '';

return [
    'auth_on' => true,
    'auth_type' => AUTH_TYPE_REAL_TIME, // TODO: default
    'auth_group' => $databasePrefix . 'auth_group',
    'auth_rule' => $databasePrefix . 'auth_rule',
    'auth_user' => $databasePrefix . 'user',
    'auth_group_access' => $databasePrefix . 'auth_group_access',
];

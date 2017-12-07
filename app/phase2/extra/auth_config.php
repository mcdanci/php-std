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
    'auth_type' => AUTH_TYPE_REAL_TIME, // TODO: default `认证方式，1为时时认证；2为登录认证。`
    'auth_group' => $databasePrefix . 'auth_group', // `用户组数据`
    'auth_rule' => $databasePrefix . 'auth_rule', // `权限规则`
    'auth_user' => $databasePrefix . 'member', // `用户信息`
    'auth_group_access' => $databasePrefix . 'auth_group_access', // `用户组明细`
];

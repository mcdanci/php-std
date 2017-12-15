<?php
/**
 * **WE CAN DO IT JUST THINK (IT)**
 *
 * [Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0) licensed.
 * @copyright 2006 ~ 2016, ThinkPHP <http://thinkphp.cn/>. All rights reserved.
 * @author 流年 (liu21st) <liu21st@gmail.com>
 * @author yunwuxin <448901948@qq.com>
 * @author <outieyi@milianjie.com>
 */

/**
 * Configuration name.
 */
const
APP_TRACE = 'app_trace',

TIMEZONE_DEFAULT = 'default_timezone',

LANG_SWITCH = 'lang_switch_on',
LANG_DEFAULT = 'default_lang',

TEMPLATE_SUCCESS = 'dispatch_success_tmpl',
TEMPLATE_ERROR = 'dispatch_success_tmpl',

RETURN_TYPE_DEFAULT = 'default_return_type',

APP_STATUS = 'app_status',

NAME_MODULE_DEFAULT = 'default_module',
NAME_CONTROLLER_DEFAULT = 'default_controller',
NAME_ACTION_DEFAULT = 'default_action',

DB_PREFIX = 'prefix';

return [
    'app_namespace' => APP_NAMESPACE,

    TIMEZONE_DEFAULT => 'Asia/Hong_Kong',

    LANG_SWITCH => true,
    LANG_DEFAULT => 'zh-hk',

    TEMPLATE_SUCCESS => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    TEMPLATE_ERROR => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    NAME_MODULE_DEFAULT => 'main',
    NAME_CONTROLLER_DEFAULT => 'Main',
    NAME_ACTION_DEFAULT => 'main',

    'name' => 'S-SHOW API',
];

<?php
/**
 * ThinkPHP
 *
 * **WE CAN DO IT JUST THINK**
 *
 * [Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0)
 *
 * @copyright http://thinkphp.cn/, 2006 ~ 2016, all rights reserved.
 * @author 流年 (liu21st) <liu21st@gmail.com>
 * @author yunwuxin <448901948@qq.com>
 * @author <outieyi@milianjie.com>
 */

// TODO
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// | Author: 流年 <liu21st@gmail.com>
// | Author: yunwuxin <448901948@qq.com>
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.

const
APP_TRACE = 'app_trace',
TIMEZONE_DEFAULT = 'default_timezone',
LANG_SWITCH = 'lang_switch_on',
LANG_DEFAULT = 'default_lang',
TEMPLATE_SUCCESS = 'dispatch_success_tmpl',
TEMPLATE_ERROR = 'dispatch_success_tmpl';

return [
    'app_namespace' => APP_NAMESPACE,
    APP_TRACE => true, // TODO: for debug

    TIMEZONE_DEFAULT => 'Asia/Hong_Kong',

    LANG_SWITCH => true,
    LANG_DEFAULT => 'zh-hk',

    TEMPLATE_SUCCESS => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    TEMPLATE_ERROR => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
];

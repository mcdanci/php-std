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
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.

return [
    'app_trace' => true, // TODO: for debug

    'app_namespace' => APP_NAMESPACE,

    'default_timezone' => 'Asia/Hong_Kong',

    'lang_switch_on' => true,
    'default_lang' => 'zh-hk',

    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
];

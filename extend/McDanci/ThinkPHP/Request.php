<?php
/**
 * @copyright since 17:36 19/12/2017
 * @author <mc@dancis.info>
 */
namespace McDanci\ThinkPHP;

class Request extends \think\Request
{
    const
        PARAM = 'param',
        GET = 'get',
        POST = 'post',
        PUT = 'put',
        DELETE = 'delete',
        SESSION = 'session',
        COOKIE = 'cookie',
        REQUEST = 'request',
        SERVER = 'SERVER',
        ENV = 'env',
        ROUTE = 'route',
        FILE = 'file';
}

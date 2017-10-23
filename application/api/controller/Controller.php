<?php
/**
 * @copyright since 9:24 21/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

/**
 * Class Controller
 *
 * # Status
 * Value | Meaning (`info`rmation)
 * --- | ---
 * 200 | OK
 * @package app\api\controller
 */
abstract class Controller extends \think\Controller
{
    const FORMAT_DATETIME = 'Y-m-d H:i:s';

    protected static function datetimeNow()
    {
        return date(self::FORMAT_DATETIME);
    }

    /**
     * 跨域 header
     * @param string $domainName 可信域，当且仅当「限定式跨域」时指定
     */
    private static function setHeaders($domainName = '*')
    {
        static $methodList = [
            'GET',
            'POST',
            'PUT',
            'DELETE',
        ];
        static $time = 3628800;

        header('Access-Control-Allow-Origin: ' . $domainName);
        if ($domainName != '*') {
            header('Access-Control-Allow-Credentials: true'); // TODO: 存取许可
        }

        header('Access-Control-Allow-Methods: ' . implode(', ', $methodList)); // TODO
        header('Access-Control-Max-Age: ' . $time); // TODO
    }

    protected function _initialize()
    {
        parent::_initialize();
        self::setHeaders();
    }
}

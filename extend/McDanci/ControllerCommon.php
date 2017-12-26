<?php
/**
 * @copyright since 16:33 27/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace McDanci;

use McDanci\ThinkPHP\Request;

/**
 * McDanci's Controller Common
 * @package McDanci
 */
trait ControllerCommon
{
    /**
     * @var string Format for MySQL DATATIME
     */
    private static $formatMySQLDatetime = 'Y-m-d H:i:s';

    /**
     * Cross-domain header
     * @param string $domainName Trusted domain, spec. when limited domain for deployment
     * @link https://icewing.cc/post/about-cross-origin.html#access-control-allow-headers%E7%9A%84%E9%97%AE%E9%A2%98
     * @todo
     */
    protected static function setHeaders($domainName = '*')
    {
        static $METHOD_LIST = [
            'GET',
            'POST',
            'PUT',
            'DELETE',
        ];
        static $PERIOD = 3628800;

        header('Access-Control-Allow-Headers: ' . implode(', ', ['Origin', 'X-Requested-With', 'Content-Type', 'Accept', 'Connection', 'User-Agent', 'Cookie', 'Cache-Control'])); // TODO

        if ($domainName === '*') {
            header('Access-Control-Allow-Origin: ' . $domainName);
        } else {
            header('Access-Control-Allow-Credentials: true'); // TODO: access 許可?

            // TODO
            if (is_array($domainName)) {
                foreach ($domainName as $key=> &$domain) {
                    if (Request::instance()->server('server_name') == 'localhost') {
                        header('Access-Control-Allow-Origin: http://' . Request::instance()->server('server_name') . ':8080/');
                    } else {
                        header('Access-Control-Allow-Origin: http://' . Request::instance()->server('server_name') . '/');
                    }

                    //if (mb_strpos(Request::instance()->server('server_name'), $domain)) {
                    //    //header('Access-Control-Allow-Origin: ' . $domain);
                    //} else {
                    //}
                }
            } elseif (is_string($domainName)) {
                header('Access-Control-Allow-Origin: ' . $domainName);
            }
        }

        // TODO: check
        header('Access-Control-Allow-Methods: ' . implode(', ', $METHOD_LIST));
        header('Access-Control-Max-Age: ' . $PERIOD);
    }

    /**
     * Returning presentation of current in MySQL DATETIME
     * @return bool|string
     */
    protected static function datetimeNow()
    {
        return date(self::$formatMySQLDatetime);
    }

    /**
     * String to digit within array
     * @param array $array
     * @throws \Exception
     */
    protected static function string2intInArray(&$array)
    {
        foreach ($array as &$item) {
            if (is_numeric($item)) {
                $item = (int)$item;
            } else {
                throw new \Exception;
            }
        }
    }

    /**
     * @param string $method
     * @todo
     */
    protected static function setSession($method = 'post.')
    {
        $sId = input($method . 'sid/s');
        if ($sId) {
            session_id($sId);
        }
        session_name('API_SESSION_ID'); // TODO
        session_start();
    }
}

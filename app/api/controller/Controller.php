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
    use \Fmnii\ControllerCommon;

    //region Common

    /**
     * As MySQL DATATIME
     */
    const FORMAT_DATETIME = 'Y-m-d H:i:s';

    /**
     * Cross-domain header
     * @param string $domainName Trusted domain, spec. when limited domain for deployment
     */
    private static function setHeaders($domainName = '*')
    {
        static $METHOD_LIST = [
            'GET',
            'POST',
            'PUT',
            'DELETE',
        ];
        static $PERIOD = 3628800;

        header('Access-Control-Allow-Origin: ' . $domainName);
        if ($domainName != '*') {
            header('Access-Control-Allow-Credentials: true'); // TODO: access 许可?
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
        return date(self::FORMAT_DATETIME);
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

    //endregion

    //region Application Common

    /**
     * Common type definition
     */
    const
        COMMON_TYPE_EXHIBITOR = 1,
        COMMON_TYPE_VISITOR = 2;

    protected function _initialize()
    {
        parent::_initialize();
        self::setHeaders();
    }

    //endregion
}

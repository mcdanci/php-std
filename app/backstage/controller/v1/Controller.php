<?php
/**
 * @copyright since 17:09 18/12/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use McDanci\ThinkPHP\Config;
use McDanci\ThinkPHP\Request;
//use think\controller\Rest; // TODO

abstract class Controller extends \think\Controller
{
    /**
     * @todo
     */
    use
        \Fmnii\Controller\Common,
        \McDanci\ControllerCommon;

    /**
     * @todo
     */
    protected function _initialize()
    {
        parent::_initialize();

        // TODO: for debug

        $headerOrigin = '*';

        /**
         * @var array Diff by environment
         */
        $headerOriginAllowedList = Config::get('origin_allowed');

        $requestHeaderOrigin = Request::instance()->header('Origin');

        if (true) { // TODO
            $headerOrigin = in_array($requestHeaderOrigin, $headerOriginAllowedList) ? $requestHeaderOrigin : $headerOrigin;
        } else {
            if (true) {
                $headerOrigin = $requestHeaderOrigin;
            } else {
                $headerOrigin = $requestHeaderOrigin ?: $headerOrigin;
            }
        }

        self::setHeaders($headerOrigin);
        //self::setHeaders('dfdsafdsafdsaf');
        //self::setHeaders(['http://localhost:8080', 'http://test.ershaoyes.com/', 'http://127.0.0.1']); // TODO: for debug
        //self::setHeaders(); // TODO: for debug
    }

    /**
     * Variable checker for string.
     * @param $string
     * @param string $varName
     * @return bool|string
     * @todo 是否不必要于 TP5 中
     */
    protected static function checkInputString(&$string, $varName = null)
    {
        if (is_string($string) && strlen($string)) {
            return true;
        } else {
            throw new \RuntimeException(ucfirst(is_string($varName) ? $varName : 'Variable') . ' is missing');
        }
    }
}

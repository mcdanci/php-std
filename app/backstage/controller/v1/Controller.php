<?php
/**
 * @copyright since 17:09 18/12/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

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

    protected function _initialize()
    {
        parent::_initialize();

        // TODO: for debug

        $headerOrigin = '*';
        $headerOriginAllowedList = [
            // Development
            'http://localhost:8080',
            'http://test.ershaoyes.com',

            // Production
            'https://web.s-show.fmnii.e13.cc',
        ]; // Diff by environment

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
}

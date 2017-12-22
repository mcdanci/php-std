<?php
/**
 * @copyright since 17:16 18/12/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use McDanci\ThinkPHP\Config;
use think\Session;

abstract class SignedController extends Controller
{
    /**
     * @return array
     * @throws \Exception
     * @todo 判斷環境 behaviour
     */
    protected function _initialize()
    {
        parent::_initialize();
        self::setSession();
        self::setHeaders();

        if (!Config::get('app_debug') || Config::get('auth_forced')) {
            if (Session::get('is_admin') === null) {
                // TODO
                exit(json_encode(self::retTemp(self::$scForbidden, 'Forbidden')));
            }
        }
    }
}

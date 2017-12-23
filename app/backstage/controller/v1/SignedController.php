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

        // TODO
        if (!Config::get('app_debug') || Config::get('backstage.auth_forced')) {
            $isAdmin = Session::get('is_admin');

            if ($isAdmin === null || !is_numeric($isAdmin) || $isAdmin < time()) {
                exit(json_encode(self::retTemp(self::$scForbidden, 'Forbidden'))); // TODO
            }
        }
    }
}

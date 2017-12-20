<?php
/**
 * @copyright since 17:16 18/12/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use think\Session;

abstract class SignedController extends Controller
{
    /**
     * @return array
     * @throws \Exception
     * @todo 判斷環境
     */
    protected function _initialize()
    {
        parent::_initialize();
        //self::setSession();
        self::setHeaders();

        //if (Session::get('is_admin') === null) {
        //    // TODO
        //    exit(json_encode(self::retTemp(self::$scNotFound, null)));
        //}
    }
}

<?php
/**
 * @copyright since 9:24 22/12/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use think\Session;

class Dashboard extends SignedController
{
    /**
     * @return array
     * @throws \Exception
     * @todo
     */
    public function main()
    {
        return self::retTemp();
    }

    /**
     * 登出。
     * @return array
     * @throws \Exception
     */
    public function SignOut()
    {
        Session::clear();
        return self::retTemp(self::$scOK);
    }
}

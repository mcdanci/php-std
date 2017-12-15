<?php
namespace app\backstage\controller;

use think\Controller;
use think\Db;

class Main extends Controller
{
    /**
     * @todo
     */
    use
        \Fmnii\Controller\Common,
        \McDanci\ControllerCommon;

    /**
     * @param int $page
     * @param null $rowMax
     * @return array
     * @throws \Exception
     * @todo for debug, Zain
     */
    public function listMember($page = 1, $rowMax = null)
    {
        self::setHeaders();
        $data = Db::name('member')->page($page, $rowMax)->select();

        return self::retTemp(self::$scOK, 'OK', $data);
    }
}

<?php
/**
 * @copyright since 17:09 18/12/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use think\controller\Rest;

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
        self::setHeaders(['http://localhost:8080', 'http://test.ershaoyes.com/', 'http://127.0.0.1']); // TODO: for debug
    }
}

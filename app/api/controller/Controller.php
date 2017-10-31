<?php
/**
 * @copyright since 9:24 21/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

/**
 * Abstract Controller
 * @package app\api\controller
 */
abstract class Controller extends \think\Controller
{
    //region Common

    use \Fmnii\Controller\Common;
    use \McDanci\ControllerCommon;

    /**
     * Format for MySQL DATATIME
     */
    const FORMAT_DATETIME = 'Y-m-d H:i:s';

    //endregion

    //region Application Common

    /**
     * Data definition: common - type
     */
    const
        COMMON_TYPE_EXHIBITOR = 1,
        COMMON_TYPE_VISITOR = 2;

    /**
     * Init.
     * @todo Unit test
     */
    protected function _initialize()
    {
        parent::_initialize();
        self::setHeaders();
    }

    //endregion
}

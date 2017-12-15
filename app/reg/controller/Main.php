<?php
/**
 * @copyright since 15:23 31/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\reg\controller;

use app\common\model\Reg;
use app\common\model\RegExhibitor;
use McDanci\ThinkPHP\Config;
use think\Controller;

/**
 * Overview
 * @package app\reg\controller
 * @todo API version
 */
class Main extends Controller
{
    /**
     * @todo
     */
    use \Fmnii\Controller\Common;
    use \McDanci\ControllerCommon;

    /**
     * @todo
     */
    //region Debug

    public function debug()
    {
        $reg = Reg::get(1, ['reg_exhibitor', 'reg_visitor']);
        return $reg;
        //return $reg->regExhibitor->save(['mpt' => 'dfsdfsdfasdf']);
    }

    //endregion

    /**
     * List gender.
     * @param string $aaa = 234234
     * @return array
     * ->**status** `int`
     *
     * ->**info** `string`
     *
     * ->**body** `array`
     *
     * ->-> `null|string`
     * @throws \Exception
     * @todo Unit test
     */
    public function listGender()
    {
        return self::retTemp(self::$scOK, 'OK', Config::get('option-gender'));
    }
}

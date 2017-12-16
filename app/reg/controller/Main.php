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
 * @todo Unit test
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
        //$reg->appendRelationAttr('RegExhibitor', 'exhibitor_tse'); // TODO
        //return $reg->regExhibitor->save(['mpt' => 'dfsdfsdfasdf']);
        //return (new Reg($_POST))->allowField(true)->save();

        // TODO: move to model
        $reg = (new Reg($_POST))->allowField(true);
        $reg->reg_exhibitor = (new RegExhibitor($_POST))->allowField(true);
        return $reg->together(['reg_exhibitor'])->save();
    }

    /**
     * @return \think\Request
     * @todo
     */
    public function regExhibitor()
    {
        return $this->request;
    }

    /**
     * @return \think\Request
     * @todo
     */
    public function regVisitor()
    {
        return $this->request->baseUrl();
    }

    //endregion

    /**
     * Get project information.
     * @return array
     * ->**status** `int`
     *
     * ->**info** `string`
     *
     * ->**body** `array`
     *
     * ->->**code** `string` Project code
     * ->->**slogan** `string` Project slogan
     * ->->**name** `string` Project name
     * @throws \Exception
     */
    public function getProjectInfo()
    {
        return self::retTemp(self::$scOK, 'OK', Config::get('project_info'));
    }

    /**
     * List gender.
     * @return array
     * ->**body** `array`
     *
     * ->-> `null|string`
     * @throws \Exception
     */
    public function listGender()
    {
        return self::retTemp(self::$scOK, 'OK', Config::get('option-gender'));
    }
}

<?php
namespace app\reg\controller\v1;

use think\Controller;
use think\Request;
use McDanci\ThinkPHP\Config;
use app\common\model\Reg;
use app\common\model\RegExhibitor;

/**
 * Overview
 * @package app\reg\controller\v1
 * @todo Unit test
 */
class Main extends Controller
{
    /**
     * @todo
     */
    use \Fmnii\Controller\Common;
    use \McDanci\ControllerCommon;

    //region Original

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }

    //endregion

    //region Main

    /**
     * @param $version
     * @todo
     */
    private static function setHeaderAPIVersion($version)
    {
        //header('X-Version: ' . $version);
        //header('X-Runtime: ' . $version);
        header(implode(': ', ['API-Version', $version]));
    }

    protected function _initialize()
    {
        parent::_initialize();
        self::setHeaders();
        self::setHeaderAPIVersion(1);
    }

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

    //endregion

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

    public function debug2($id = 1)
    {
        return (new Reg)->allowField(true)->save($_POST, ['id' => $id]);
    }

    public function debug3()
    {
        return $this->request->header('API-Version') ?: new \stdClass();
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
}

<?php

namespace app\backstage\controller\v1;

use app\common\model\Reg;
use McDanci\ThinkPHP\Config;
use think\Request;

/**
 * Class Audit
 * @package app\backstage\controller\v1
 * @todo
 */
class Audit extends SignedController
{
    //region Original

    /**
     * 显示资源列表
     *
     * @return \think\Response
     * @todo
     */
    public function _main()
    {
        new \think\Response();
        return null;
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
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
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
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
    }

    //endregion

    /**
     * @return false|\PDOStatement|string|\think\Collection
     * perpage @ header
     *
     */
    public function main($page = 1, $pageRow = null)
    {
        if ($pageRow === null) {
            $pageRow = Config::get('paginate.list_rows');
        }

        // TODO: ORDER
        $result = Reg::getByStatus(Reg::STATUS_UNAUDITED)
            ->field('password', true)
            ->where(['status' => Reg::STATUS_UNAUDITED])
            ->order(['id' => Reg::ORDER_DESC])
            ->paginate($pageRow)->each(function ($item, $key) {
                return $item;
            });

        return $result;

        //return self::retTemp(self::$scOK, null, $data);
    }
}

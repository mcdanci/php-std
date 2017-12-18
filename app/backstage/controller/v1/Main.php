<?php
/**
 * @copyright since 15:23 31/10/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use think\Request;
use think\Db;
use think\Session;

class Main extends Controller
{
    //region Original

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
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

    //region Debug

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

    //endregion

    /**
     * @return array
     * @todo
     */
    public function main()
    {
        return [];
    }

    /**
     * @param string $username
     * @param null $password
     * @todo
     */
    public function signIn($username = 'admin', $password = null)
    {
        if ($username === 'admin' && $password === 'admin') {
            self::setSession();
            Session::set('is_admin', true);
            return self::retTemp(self::$scOK);
        } else {
            return self::retTemp(self::$scNotFound);
        }
    }
}
<?php
/**
 * @copyright since 15:23 31/10/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use app\common\model\Common;
use McDanci\ThinkPHP\Config;
use think\Request;
use think\Db;
use think\Response;
use think\Session;

class Main extends Controller
{
    //region Debug

    /**
     * @param int $page
     * @param null $rowMax
     * @return array
     * @throws \Exception
     * @todo for debug, Zain
     * @deprecated
     */
    public function listMember($page = 1, $rowMax = null)
    {
        self::setHeaders();
        $data = Db::name('member')->page($page, $rowMax)->select();

        return self::retTemp(self::$scOK, 'OK', $data);
    }

    //region Original

    /**
     * 显示创建资源表单页.
     * @return \think\Response
     * @deprecated
     */
    public function create()
    {
    }

    /**
     * 保存新建的资源
     * @param  \think\Request $request
     * @return \think\Response
     * @deprecated
     */
    public function save(Request $request)
    {
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     * @deprecated
     */
    public function read($id)
    {
    }

    /**
     * 显示编辑资源表单页.
     * @param  int $id
     * @return \think\Response
     * @deprecated
     */
    public function edit($id)
    {
    }

    /**
     * 保存更新的资源
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     * @deprecated
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * 删除指定资源
     * @param  int $id
     * @return \think\Response
     * @deprecated
     */
    public function delete($id)
    {
    }

    //endregion

    //endregion

    //region Main

    /**
     * Get app status.
     * @return array
     * ->**body** `array`
     *
     * ->->**status** `bool` App runtime status
     * @throws \Exception
     */
    public function main()
    {
        return self::retTemp(self::$scOK, null, ['status' => true]);
    }

    /**
     * Get session id in cookie.
     * @return array
     * ->**body** `array`
     *
     * ->->**session_id** `string` Session id
     * @throws \Exception
     * @deprecated
     */
    public function getSessionId()
    {
        self::setSession();
        return self::retTemp(self::$scOK, null, ['session_id' => session_id()]);
    }

    /**
     * 登入。
     * @param null|string $username
     * @param null|string $password
     * @return \think\Response|array
     * ->**status** `int` 200 for successful, or 404 far failure.
     * @throws \Exception
     */
    public function signIn($username = null, $password = null)
    {
        $userList = Config::get('backstage.user');

        if (($userList && is_array($userList)) &&
            ($username && $password) &&
            array_key_exists($username, $userList) &&
            password_verify($password, $userList[$username]['password'])
        ) {
            self::setSession();

            Session::set('is_admin', time() + 3600 * 24 * 7); // 七日
            Session::set('username', $username);

            return self::retTemp(self::$scOK, 'Signed in successful');
        } else {
            return self::retTemp(self::$scNotFound, 'There must be something wrong');
        }
    }

    //endregion
}

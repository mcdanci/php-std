<?php
namespace app\dashboard\controller\v1;

use app\common\model\Reg;
use McDanci\ThinkPHP\Config;
use think\Session;

class Main extends Controller
{
    //region Debug

    /**
     * @return mixed
     * @todo Password demo
     */
    public function debug()
    {
        //return Env::get('database.//username');

        // TODO: 255 for password storage, <= 72 chars
        $passwordOptionList = [
            'cost' => 8,
        ];
        $passwordHashed = password_hash('password', PASSWORD_DEFAULT, $passwordOptionList);
        if ($passwordHashed === false) {
            throw new \Exception('Password too long? (Max. <= 72 chars)');
        } elseif ($passwordHashed) {
            if (password_needs_rehash($passwordHashed, PASSWORD_DEFAULT)) {
                $newHash = password_hash('password', PASSWORD_DEFAULT); // TODO: new hash
            }
            return json([
                $passwordHashed,
                password_get_info($passwordHashed),
                password_verify('password', $passwordHashed),
            ]);
        } else {
            return false;
        }
    }

    /**
     * @return \think\response\View
     * @todo
     * @see app/phase2/view/main/_debug.tpl
     */
    public function main()
    {
        $this->assign([
            'welcome' => \app\common\model\Common::INFO_WELCOME,
        ]);
        return view();
    }

    //endregion

    //region Main

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
        if ($username && $password) {
            $reg = new Reg();
            $passwordInStorage = $reg->where(['email' => $username])->value('password');

            if ($passwordInStorage &&
                password_verify($password, $passwordInStorage)
            ) {
                self::setSession();
                Session::set('is_registrant', time() + 3600 * 24 * 7); // 七日
                Session::set('username', $username);

                return self::retTemp(self::$scOK, 'Signed in successful');
            }
        }

        return self::retTemp(self::$scForbidden, 'There must be something wrong');
    }

    //endregion
}

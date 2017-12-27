<?php
namespace app\dashboard\controller\v1;

use app\common\model\Booth;
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

    /**
     * 驗證。
     * @return array|\think\Response
     * @throws \Exception
     * @deprecated
     * @todo
     */
    public function checkBooth()
    {
        $dataByZone = [];
        $range = [
            'A' => range(1, 28),
            'B' => range(101, 297),
            'C' => range(301, 483),
            'D' => range(501, 539),
            'E' => range(601, 692),
            'F' => range(701, 758),
            'G' => range(801, 849),
            'H' => range(901, 936),
        ];

        $booth = new Booth();

        $dataByZone = [
            $booth->where(['zone' => 1])->column('id'),
        ];

        return self::retTemp(self::$scOK, null, []);
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
     * @todo status = 2 @ where
     */
    public function signIn($username = null, $password = null)
    {
        if ($username && $password) {
            $reg = new Reg();
            $regInfo = $reg->where(['email' => $username])->find();
            
            if ($regInfo) {
                $passwordInStorage = $regInfo['password'];

                if ($passwordInStorage &&
                    password_verify($password, $passwordInStorage)
                ) {
                    self::setSession();
                    Session::set('is_registrant', time() + 3600 * 24 * 7); // 七日
                    Session::set('username', $username);

                    return self::retTemp(self::$scOK, 'Signed in successful', [
                        'role_type' => $regInfo['type'],
                        'reg' => [
                            'id' => $regInfo['id'],
                            'role_type' => $regInfo['type'],
                        ],
                    ]);
                }
            }
        }

        return self::retTemp(self::$scNotFound, 'There must be something wrong');
    }

    /**
     * 列出展位选项：类型同区域。
     * @return array|\think\Response
     * ->**body** `object`
     *
     * ->->**type** `array` 展位类型清单
     *
     * ->->-> `object` 展位类型
     *
     * ->->->->**value** `int` 码
     *
     * ->->->->**name** `string` 描述
     *
     * ->->**zone** `array` 展区清单
     *
     * ->->-> `object` 展区
     *
     * ->->->->**value** `int` 码
     *
     * ->->->->**name** `string` 描述
     *
     * @throws \Exception
     */
    public function listBoothOpt()
    {
        $confBoothType = Config::get('booth_type');
        foreach ($confBoothType as $key => &$item) {
            if ($item === null) {
                unset($confBoothType[$key]);
            } else {
                $item = [
                    'value' => $key + 1,
                    'name' => $item['name'],
                    'colour' => $item['colour'],
                ];
            }
        }
        $confBoothType = array_values($confBoothType);

        $confBoothZone = Config::get('booth_zone');
        foreach ($confBoothZone as $key => &$item) {
            $item = [
                'value' => $key + 1,
                'name' => $item,
            ];
        }

        return self::retTemp(self::$scOK, null, [
            'type' => $confBoothType,
            'zone' => $confBoothZone,
        ]);
    }

    /**
     * 列出所有的展位
     * @return array|\think\Response
     * ->**body** `array`
     *
     * ->-> `object` Tuple
     *
     * ->->->**id** `int` Booth ID
     *
     * ->->->**x** `float` 横坐标
     *
     * ->->->**y** `float` 纵坐标
     *
     * ->->->**zone** `string` Booth zone
     *
     * ->->->**type** `int` Booth type, {1: blue, 2: yellow}
     *
     * ->->->**is_courtyard** `int` Booth ID TODO @deprecated
     *
     * ->->->**number** `string` Booth number
     * @throws \Exception
     * @deprecated
     * @todo
     */
    public function listBooth()
    {
        $booth = new Booth();
        return self::retTemp(self::$scOK, null, $booth->select());
    }

    //endregion
}

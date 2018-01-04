<?php
/**
 * @copyright since 15:01 27/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\Common;
use app\common\model\Reg;
use think\Db;
use think\db\Query;
use think\Session;

/**
 * Class Account
 * @package app\dashboard\controller\v1
 * @todo 将 id 相关的换成 $this->regId
 */
class Account extends SignedController
{
    protected $reg;

    /**
     * Get profile of registrant.
     * @return array|\think\Response
     * @throws \Exception
     * @throws \think\Exception
     */
    public function main()
    {
        $id = $this->regId;

        if ($id) {
            if (is_numeric($id)) {
                $reg = new Reg();
                $result = $reg->field('type')->find($id);
                if ($result) {
                    $relationSet = [];

                    switch ($result->toArray()['type']) {
                        case 'exhibitor':
                            $relationSet[] = 'regExhibitor';
                            break;
                        case 'visitor':
                            $relationSet[] = 'regVisitor';
                            break;
                    }

                    return self::retTemp(self::$scOK, null, $reg->get(function (Query $query) {
                        $query->field(['password'], true)->where(['id' => Session::get('reg_id')]); // TODO
                    }, $relationSet)->toArray());
                }
            }
        }

        return self::retTemp(self::$scNotFound);
    }

    /**
     * Change password.
     * @param null $password_original
     * @param null $password_new
     * @return array|\think\Response
     * @throws \Exception
     */
    public function modPassword($password_original = null, $password_new = null)
    {
        if ($password_original &&
            $password_new &&
            $this->reg = Reg::get($this->regId)
        ) {
            if ($password_original &&
                $password_new
            ) {
                $regInfo = $this->reg->toArray();

                if (password_verify($password_original, $regInfo['password'])) {
                    //$result = $this->reg->update(['password' => Common::encryptPassword($password_new)], $id); // TODO: ?
                    $result = $this->reg->save(['password' => Common::encryptPassword($password_new)]);

                    if ($result) {
                        Db::name('debug')->insert([
                            'k' => 'passwd_mod',
                            'body' => json_encode([
                                'reg_id' => $this->regId,
                                'password_original' => $password_original,
                                'r_o' => $regInfo['password'],
                                'r_current' => $this->reg->password,
                                'password_new' => $password_new,
                                'created' => self::datetimeNow(),
                            ]),
                        ]);
                        \session(null); // TODO
                        return self::retTemp();
                    }
                }
            }
        }

        return self::retTemp(self::$scNotFound, 'Something wrong');
    }
}

<?php
/**
 * @copyright since 15:01 27/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\Common;
use app\common\model\Reg;
use think\db\Query;
use think\Session;

/**
 * Class Account
 * @package app\dashboard\controller\v1
 * @todo 将 id 相关的换成 $this->regId
 */
class Account extends SignedController
{
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
     * 修改密码。
     * @param null $password_original
     * @param null $password_new
     * @return array|\think\Response
     * @throws \Exception
     */
    public function modPassword($password_original = null, $password_new = null)
    {
        $id = $this->regId;

        if ($id) {
            $reg = new Reg();

            if ($password_original &&
                $password_new &&
                $regInfo = $reg->find($id)
            ) {
                if (password_verify($password_original, $regInfo['password'])) {
                    $result = $reg->update(['password' => Common::encryptPassword($password_new)], ['id' => $id]);
                    if ($result) {
                        return self::retTemp();
                    }
                }
            }
        }

        return self::retTemp(self::$scNotFound, 'Something wrong');
    }
}

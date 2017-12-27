<?php
/**
 * @copyright since 15:01 27/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\Common;
use app\common\model\Reg;

class Account extends SignedController
{
    /**
     * 改密码
     * @param null $id
     * @param null $password_original
     * @param null $password_new
     * @return array|\think\Response
     * @throws \Exception
     */
    public function modPassword($id = null, $password_original = null, $password_new = null)
    {
        $reg = new Reg();

        if ($password_original &&
            $password_new &&
            $regInfo = $reg->find($id)
        ) {
            if (password_verify($password_original, $regInfo['password'])) {
                $result = $reg->update(['password' => Common::encryptPassword($password_new)], ['id' => $id]);
                if ($result) {
                    return self::retTemp(self::$scOK);
                }
            }
        }

        return self::retTemp(self::$scOK, 'Something wrong');
    }
}

<?php

/**
 * @copyright since 13:56 29/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\Reg;

class Dashboard extends SignedController
{
    /**
     * @return array|\think\Response
     */
    public function readAgreement()
    {
        if ($this->regId) {
            $reg = Reg::get($this->regId);
            if ($reg && $reg['agreement'] == $reg::AGREEMENT_UNREAD) {
                $reg['agreement'] = $reg::AGREEMENT_READ;
                return self::retTemp(self::$scOK, null, [$reg->save()]);
            }
        }

        return self::retTemp(self::$scNotFound);
    }
}

<?php
/**
 * @copyright since 15:38 26/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\Booth;

class Selection extends SignedController
{
    public function main()
    {
        return self::retTemp();
    }

    public function listBooth($type = null, $zone = null, $id = null)
    {
        $booth = new Booth();
        return self::retTemp(self::$scOK, null, $booth->select());
    }
}

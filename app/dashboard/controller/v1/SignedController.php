<?php
/**
 * @copyright since 12:28 23/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\Reg;
use think\Session;

/**
 * @todo
 */
abstract class SignedController extends \app\backstage\controller\v1\SignedController
{
    //region Common

    /**
     * @var int Registrant ID
     */
    protected $regId;

    /**
     * @var null|Reg
     */
    protected $reg;

    protected function _initialize()
    {
        parent::_initialize();

        $regId = Session::get('reg_id');

        if ($regId) {
            $this->regId = Session::get('reg_id');

            $this->reg = Reg::get($this->regId);
        } // TODO: else denied
    }

    //endregion
}

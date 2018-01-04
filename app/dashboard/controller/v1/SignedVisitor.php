<?php
/**
 * @copyright since 18:01 3/1/2018
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use think\Session;

class SignedVisitor extends SignedController
{
    protected $regId;

    /**
     * @todo
     */
    protected function _initialize()
    {
        parent::_initialize();

        $regId = Session::get('reg_id');
        if ($regId) {
            $this->regId = Session::get('reg_id');
        } // TODO: else denied
    }
}

<?php
/**
 * @copyright since 12:28 23/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use think\Session;

/**
 * @todo
 */
abstract class SignedController extends \app\backstage\controller\v1\SignedController
{
    protected $regId;

    protected function _initialize()
    {
        parent::_initialize();

        $regId = Session::get('reg_id');
        if ($regId) {
            $this->regId = Session::get('reg_id');
        }
    }
}

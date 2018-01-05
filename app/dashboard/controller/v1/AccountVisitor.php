<?php
/**
 * @copyright since 17:56 3/1/2018
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

class AccountVisitor extends Account
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * @todo
     */
    public function getTicket()
    {
        if ($this->reg->tableOrder()->where(['status' => \app\common\model\Order::STATUS_UNPAID])) {
            //
        }
    }
}

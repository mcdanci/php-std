<?php
/**
 * @copyright since 11:03 3/1/2018
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model;
use think\Db;

/**
 * Class OrderVisitor
 * @package app\dashboard\controller\v1
 * @todo 一旦付款完毕，分配五个票，票据带有 active 标识
 * @todo 预设激活一个，可选四个
 */
class OrderVisitor extends Order
{
    public function setBankAccountName($bank_account_name = null)
    {
        return parent::setBankAccountName($bank_account_name); // TODO: Change the autogenerated stub
    }

    //region Checkout

    /**
     * Place order with bank account name & ticket type (for limitation of entry fee).
     * @param null|string $bank_account_name
     * @param null|int $ticket_type {1: single, 2: both}
     * @return array|\think\Response
     */
    public function checkout($bank_account_name = null, $ticket_type = null)
    {
        try {
            self::checkInputString($bank_account_name, 'bank account name');
            self::checkInputString($ticket_type, 'ticket type');
        } catch (\RuntimeException $exception) {
            return self::retTemp(self::$scNotFound, $exception->getMessage());
        }

        if (is_numeric($ticket_type) && in_array($ticket_type, model\OrderVisitor::getRangeTicketType())) {
            if ($order = model\Order::get(['reg_id' => $this->regId])) {
                return self::retTemp(self::$scNotFound, 'Order already exists');
            } else {
                if (($price = model\OrderVisitor::getFee($ticket_type)) === false) {
                    return self::retTemp(self::$scNotFound, 'Error on price taking');
                }

                $data = [
                    'reg_id' => $this->regId,
                    'amount' => $price,
                ];

                $order = new model\Order($data);
                $order->orderVisitor = ['ticket_type' => $ticket_type];
                $result = $order->together('orderVisitor')->save();

                if ($result) {
                    Db::name('debug')->insert([
                        'k' => 'visitor_ticket',
                        'body' => json_encode(array_merge($data, ['created' => self::datetimeNow()])),
                    ]); // TODO
                    return self::retTemp(self::$scOK, null, [
                        '_debug' => [
                            'result' => $result,
                            'data_original' => $data,
                        ],
                    ]);
                } else {
                    return self::retTemp(self::$scNotFound, null, [
                        '_debug' => [
                            'data' => $data,
                        ],
                    ]);
                }
            }
        }

        return self::retTemp(self::$scNotFound);
    }

    /**
     * @todo check if is visitor
     */
    protected function _initialize()
    {
        parent::_initialize();
    }

    //endregion
}

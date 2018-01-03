<?php
/**
 * @copyright since 11:03 3/1/2018
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model;
use think\Db;
use think\Response;

/**
 * Class OrderVisitor
 * @package app\dashboard\controller\v1
 * @todo 一旦付款完毕，分配五个票，票据带有 active 标识
 * @todo 预设激活一个，可选四个
 */
class OrderVisitor extends Order
{
    //region Common

    protected $reg;

    /**
     * @todo check if is visitor
     */
    protected function _initialize()
    {
        parent::_initialize();

        if ($this->reg = model\Reg::get($this->regId)) {
            if ($this->reg->toArray()['type'] !== 'visitor') {
                Response::create(self::retTemp(self::$scForbidden, self::TIP_ACCESS_VISITOR), 'json');
            }
        }
    }

    //endregion

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
                    'bank_account_name' => $bank_account_name,
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

    //endregion

    /**
     * Get order description.
     * @return array|Response
     */
    public function getOrderDesc()
    {
        if ($this->order = model\Order::get(['reg_id' => $this->regId], 'orderVisitor')) {
            $result = $this->order->toArray();

            // TODO: to be opt
            if ($result) {
                // TODO
                $result['method'] = 'direct bank transfer';
                $result['method'] = ucfirst($result['method']);

                if (array_key_exists('order_visitor', $result)) {
                    $result['order_visitor']['ticket_type_desc'] = model\OrderVisitor::$mapAttrTicketType[$result['order_visitor']['ticket_type']];
                }
            }

            return self::retTemp(self::$scOK, null, $result);
        } else {
            return self::retTemp(self::$scNotFound);
        }
    }
}

<?php
namespace app\common\model;

use McDanci\ThinkPHP\Config;
use traits\model\SoftDelete;

/**
 * Model Order
 * @package app\common\model
 * @property null|string $bank_account_name Bank account name TODO
 * @todo create with pay_deadline for exhibitor
 */
class Order extends Model
{
    use SoftDelete;

    //region Configuration

    const
        STATUS_INVALID = 0,
        STATUS_UNPAID = 1,
        STATUS_RECEIPT_UPLOADED = 2,
        STATUS_PAID = 3;

    protected
        $autoWriteTimestamp = self::DATETIME,
        $deleteTime = 'deleted';

    /**
     * @var array
     * @todo
     */
    protected $auto = [];
    protected $update = [];

    protected $insert = [
        'status' => self::STATUS_UNPAID,
        'exhibitor_pay_deadline',
    ];

    /**
     * @var bool
     */
    public $isExhibitor = false;

    //endregion

    //region Relation

    public function reg()
    {
        return $this->belongsTo('Reg');
    }

    public function orderExhibitorBooth()
    {
        return $this->hasMany('OrderExhibitorBooth');
    }

    public function orderVisitor()
    {
        return $this->hasOne('OrderVisitor');
    }

    //endregion

    /**
     * @return false|string
     * @todo
     */
    public function setExhibitorPayDeadlineAttr($value)
    {
        if ($this->isExhibitor) {
            $value = date(self::FORMAT_MYSQL_DATETIME, time() + 60 * Config::get('exhibitor_pay_deadline_in_min'));
        }

        return $value;
    }
}

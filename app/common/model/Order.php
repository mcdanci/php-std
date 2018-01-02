<?php
namespace app\common\model;

use traits\model\SoftDelete;

/**
 * Model Order
 * @package app\common\model
 * @todo create with pay_deadline for exhibitor
 * @todo if exhibitor then 自动跑，15 分钟过期？
 */
class Order extends Model
{
    use SoftDelete;

    //region Configuration

    const
        STATUS_INVALID = 0,
        STATUS_UNPAID = 1,
        STATUS_RECEIPT_UPLOADED = 2;

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

    //endregion

    /**
     * @return false|string
     * @todo
     */
    public function setExhibitorPayDeadlineAttr($value)
    {
        if ($this->isExhibitor) {
            $value = date(self::FORMAT_MYSQL_DATETIME, time() + 60 * 15);
        }

        return $value;
    }
}

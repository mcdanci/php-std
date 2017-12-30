<?php
namespace app\common\model;

use traits\model\SoftDelete;

/**
 * Class Order
 * @package app\common\model
 * @todo create with pay_deadline for exhibitor
 * @todo if exhibitor then 自动跑，15 分钟过期？
 */
class Order extends Model
{
    use SoftDelete;

    //region Configuration

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
        'exhibitor_pay_deadline',
    ];

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

    public function setExhibitorPayDeadlineAttr()
    {
        return date(self::FORMAT_MYSQL_DATETIME, time() + 60 * 15);
    }
}

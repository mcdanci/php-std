<?php
namespace app\common\model;

use traits\model\SoftDelete;

/**
 * Class Order
 * @package app\common\model
 * @todo create with pay_deadline for exhibitor
 */
class Order extends Model
{
    use SoftDelete;

    protected
        $autoWriteTimestamp = 'datetime',
        $deleteTime = 'deleted';
}

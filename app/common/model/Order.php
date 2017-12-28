<?php
namespace app\common\model;

use traits\model\SoftDelete;

class Order extends Model
{
    use SoftDelete;

    protected
        $autoWriteTimestamp = 'datetime',
        $deleteTime = 'deleted';
}

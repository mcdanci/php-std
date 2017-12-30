<?php
namespace app\common\model;

use traits\model\SoftDelete;

class Storage extends Model
{
    use SoftDelete;

    protected
        $autoWriteTimestamp = self::DATETIME,
        $deleteTime = 'deleted';
}

<?php
namespace app\common\model;

use traits\model\SoftDelete;

class RegExhibitorStaff extends Model
{
    //region Common

    use SoftDelete;

    protected
        $autoWriteTimestamp = self::DATETIME,
        $deleteTime = self::DELETED;

    //endregion
}

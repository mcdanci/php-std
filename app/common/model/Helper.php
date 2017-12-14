<?php
namespace app\common\model;

use think\Model;

class Helper extends Model
{
    /**
     * @param int $id
     * @return bool|string
     */
    public static function getAById($id)
    {
        if ($id >= 1 && $id <= 8) {
            return chr(64 + $id);
        } elseif ($id === 0) {
            return (string)$id;
        } else {
            return false;
        }
    }
}

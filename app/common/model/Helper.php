<?php
namespace app\common\model;

use think\Db;

class Helper extends Model
{
    const A_ID_OFFSET = 64;

    /**
     * @param int $id
     * @return bool|string
     */
    public static function getAById($id)
    {
        if (is_int($id)) {
            if ($id >= 1 && $id <= 8) {
                return chr(self::A_ID_OFFSET + $id);
            } elseif ($id === 0) {
                return (string)$id;
            }
        }

        return false;
    }

    /**
     * @param string $a
     * @return bool|int
     */
    public static function getIdByA($a)
    {
        if (is_string($a)) {
            if (in_array($a, range('A', 'H'))) {
                return ord($a) - self::A_ID_OFFSET;
            } elseif ($a === '0') {
                return (int)$a;
            }
        }

        return false;
    }

    /**
     * @param string $key
     * @param $body
     * @return int|string
     */
    public static function logDebug($key, $body)
    {
        return Db::name('debug')->insert([
            'k' => $key,
            'body' => json_encode($body),
        ]);
    }
}

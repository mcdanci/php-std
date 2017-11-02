<?php
/**
 * @copyright since 15:49 2/11/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace McDanci\ThinkPHP;

/**
 * Configuration Operation
 * @package McDanci\ThinkPHP
 */
class Config extends \think\Config
{
    /**
     * Getting param. within configurations
     * getting all once set with `null`
     * @param null $name Name of param. within configuration (separating with `.` supported)
     * @param string $range Range functional
     * @return mixed
     * @todo Test unit
     */
    public static function getByDot($name = null, $range = '')
    {
        if (is_string($name)) {
            $keyList = explode('.', $name);
            $counter = count($keyList);
            if ($counter > 2) {
                $v = parent::get($keyList[0] . '.' . $keyList[1], $range);

                for ($c = 2; $c < $counter; $c++) {
                    $v = $v[$keyList[$c]];
                }

                return $v;
            } else {
                return parent::get($name, $range);
            }
        } else {
            return parent::get($name, $range);
        }
    }
}

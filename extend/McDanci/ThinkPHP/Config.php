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
     * Get configuration.
     *
     * Getting all configuration at once set parameter name with `null`.
     * @param null|string $name Name of configuration parameter, level separation using `.`
     * @param string $range functional range
     * @return mixed
     * @todo Test unit
     */
    public static function getByDot($name = null, $range = '')
    {
        if (is_string($name)) {
            $keyList = explode('.', $name);
            $counter = count($keyList);
            if ($counter > 2) {
                $configValue = parent::get($keyList[0] . '.' . $keyList[1], $range);

                for ($c = 2; $c < $counter; $c++) {
                    $configValue = $configValue[$keyList[$c]];
                }

                return $configValue;
            }
        }
        return parent::get($name, $range);
    }
}

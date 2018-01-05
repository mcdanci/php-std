<?php
/**
 * @copyright since 9:49 5/1/2018
 * @author <mc@dancis.info>
 */
namespace McDanci\ThinkPHP;

use think\Env;

/**
 * General helper
 * @package McDanci\ThinkPHP
 */
class Helper
{
    /**
     * 應用調試模式與否？
     * @return bool
     */
    public static function isAppDebug()
    {
        static $ETC_NAME = 'app_debug';
        return (bool)Env::get($ETC_NAME, Config::get($ETC_NAME));
    }
}

<?php
/**
 * @copyright since 14:43 14/12/2017
 * @author <mc@dancis.info>
 */

if (!function_exists('get_a_by_id')) {
    /**
     * @param $id
     * @return bool|string
     * @see \app\common\model\Helper::getAById
     */
    function get_a_by_id($id)
    {
        return \app\common\model\Helper::getAById($id);
    }
}


if (!function_exists('log_debug')) {
    /**
     * @param string $key
     * @param $body
     * @return int|string
     */
    function log_debug($key, $body)
    {
        return \app\common\model\Helper::logDebug($key, $body);
    }
}

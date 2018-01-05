<?php
/**
 * @copyright since 14:43 14/12/2017
 * @author <mc@dancis.info>
 */

if (!function_exists('is_not_json')) {
    /**
     * @param $str
     * @return bool
     * @link http://www.jb51.net/article/47621.htm
     * @todo 不严谨
     */
    function is_not_json($str)
    {
        return is_null(json_decode($str));
    }
}

if (!function_exists('json_valid')) {
    /**
     * @param $str
     * @return bool
     */
    function json_valid($str)
    {
        return !is_not_json($str); // TODO: 不严谨
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

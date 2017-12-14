<?php
/**
 * @copyright since 14:43 14/12/2017
 * @author <mc@dancis.info>
 */

if (!function_exists('function_name')) {
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

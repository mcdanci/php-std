<?php
/**
 * @copyright since 15:50 18/12/2017
 * @author <mc@dancis.info>
 */
namespace McDanci\ThinkPHP;

/**
 * Class Model
 * @package McDanci\ThinkPHP
 *
 * @todo
 * @method static Model get($data, $with = [], $cache = false)
 */
class Model extends \think\Model
{
    const ORDER_ASC = 'asc', ORDER_DESC = 'desc';

    const TIME_CREATED = '';
    const TIME_UPDATED = '';
    const TIME_UPDATE = '';

    /**
     * @var string Field for time
     */
    protected
        $createTime = 'created',
        $updateTime = 'updated';
}

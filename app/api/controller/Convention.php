<?php
/**
 * @copyright since 11:23 31/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

use think\Config;

/**
 * Class in Fmnii Convention
 * @package app\api\controller
 */
class Convention extends Controller
{
    use \Fmnii\Controller\Convention;

    /**
     * Getting data in merged or not
     * @param bool $merge True for merging while false for not
     * @return mixed
     */
    private static function getFileMustData($merge = false)
    {
        $data = Config::get('field_must');

        if ($merge) {
            foreach (['exhibitor'] as &$role) {
                $data[$role] = array_merge($data['common'], $data[$role]);
            }
            unset($data['common']);
        }

        return $data;
    }

    /**
     * Getting fields that must not be blank
     * @param bool $merge True for merging while false for not
     * @return array
     * ->common *optional*
     * ->exhibitor
     * ->visitor
     * @throws \Exception
     */
    public function getFieldMust($merge = false)
    {
        return self::retTemp(self::$scSucceeded, null, self::getFileMustData($merge));
    }
}

<?php
/**
 * @copyright since 11:23 31/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

use think\Config;

/**
 * Convention
 * In Fmnii convention
 * @package app\api\controller
 */
class Convention extends Controller
{
    use \Fmnii\Controller\Convention;

    /**
     * @todo deleted
     */
    public function dbg()
    {
        return self::retTemp(self::$scSucceeded, null, ['body' => Config::get('category_desc')]);
    }

    /**
     * Getting data in merged or not
     * @param bool $merge True for merging while false for not
     * @return mixed
     * @todo Unit test
     */
    private static function getFileMustData($merge = false)
    {
        $data = Config::get('field_must');

        if ($merge) {
            foreach (['exhibitor', 'visitor'] as &$role) {
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
     *
     * ->exhibitor
     *
     * ->visitor
     * @throws \Exception
     * @todo Unit test
     */
    public function getFieldMust($merge = false)
    {
        return self::retTemp(self::$scSucceeded, null, self::getFileMustData($merge));
    }
}

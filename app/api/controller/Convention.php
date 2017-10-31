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
     * Getting fields that must not be blank
     * @return array
     * ->common
     * ->exhibitor
     * ->visitor
     * @throws \Exception
     */
    public function getFieldMust()
    {
        return self::retTemp(self::$scSucceeded, null, Config::get('field_must'));
    }
}

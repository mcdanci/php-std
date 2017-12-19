<?php
namespace app\main\controller;

use app\common\model\Common;
use think\Config;
use think\Controller;

/**
 * Project Main Page
 * @package app\index\controller
 */
class Main extends Controller
{
    /**
     * Welcome
     * @return string Welcome information
     */
    public function main()
    {
        return Common::getInfoWelcomeMain();
    }
}

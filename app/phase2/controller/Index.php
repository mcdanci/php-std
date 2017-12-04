<?php
namespace app\phase2\controller;

use app\phase2\model\Common;
use think\Env;

class Index
{
    /**
     * Default action.
     * @return string
     */
    public function index()
    {
        return Common::WELCOME_INFORMATION;
    }
}

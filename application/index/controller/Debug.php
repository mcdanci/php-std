<?php
/**
 * @copyright since 14:50 25/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\index\controller;

use think\Controller;

class Debug extends Controller
{
    /**
     * @todo
     */
    public function index()
    {
        $this->success('Submitted successful.');
    }
}

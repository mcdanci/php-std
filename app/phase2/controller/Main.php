<?php
/**
 * @copyright since 9:49 6/12/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\phase2\controller;

// TODO
use think\Request;

/**
 * Class Main
 * @package app\phase2\controller
 * @todo app/phase2/view/main/nav.tpl
 */
class Main extends Controller
{
    /**
     * @return \think\response\View
     * @todo
     */
    public function _empty()
    {
        return view();
    }

    /**
     * Sign out.
     * @todo
     */
    public function signOut()
    {
    }

    //region Debug

    /**
     * @return \think\response\View
     * @todo
     * @see app/phase2/view/main/_debug.tpl
     */
    public function main()
    {
        $this->assign([
            'username' => 'Zain',
        ]);
        return view();
    }

    //endregion
}

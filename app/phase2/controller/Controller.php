<?php
/**
 * @copyright since 13:48 7/12/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\phase2\controller;

use think\Auth;

class Controller extends \think\Controller
{
    /**
     * @var Auth
     */
    protected $auth;

    public function _initialize()
    {
        parent::_initialize();

        $this->auth = new Auth();

        // TODO: controller-action, session uid, to be behaviour in framework, rule list should be list as const
        if (!$this->auth->check($this->request->controller() . '-' . $this->request->action(), session('uid'))) {
            $this->error('You have no right to access.');
        }
    }
}

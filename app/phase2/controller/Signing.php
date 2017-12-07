<?php
namespace app\phase2\controller;

use think\Request;

/**
 * Signing
 * @package app\phase2\controller
 */
class Signing extends Controller
{
    /**
     * Get init. data.
     * @return array
     * @todo
     */
    public function init()
    {
        return [];
    }

    /**
     * Sign in.
     * @param Request $request
     * @return array
     * @todo username & password that has been encrypted
     */
    public function in(Request $request)
    {
        return [];
    }

    /**
     * Forget username.
     * @param Request $request
     * @return array
     * @deprecated
     * @todo 待定
     */
    public function forgetUsername(Request $request)
    {
        return [];
    }

    /**
     * Forget password.
     * @param $username
     * @return array
     * @todo
     */
    public function forgetPassword($username)
    {
        return [];
    }
}

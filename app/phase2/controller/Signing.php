<?php
namespace app\phase2\controller;

use McDanci\ThinkPHP\Config;
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

    //region Debug

    public function payDebug()
    {
        Config::set(RETURN_TYPE_DEFAULT, 'html');
        $this->assign([
            'business' => 'east.usa@fmnii.com',
            'item_name' => 'S Show Transaction',
            'currency_code' => 'USD',
            'amount' => 0.0,
            'btn_submit_img' => [
                'src' => 'https://www.paypal.com/zh_XC/i/btn/x-click-but01.gif',
                'alt' => 'Make payments with PayPal - it\'s fast, free and secure!',
            ],
        ]);
        return $this->display('_tmp/payment');
    }

    //endregion
}

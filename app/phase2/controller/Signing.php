<?php
namespace app\phase2\controller;

use McDanci\ControllerCommon;
use McDanci\ThinkPHP\Config;
use think\Db;
use think\Request;

/**
 * Signing
 * @package app\phase2\controller
 */
class Signing extends Controller
{
    use
        \Fmnii\Controller\Common,
        ControllerCommon;

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

    /**
     * Boolean value of PayPal
     */
    const
        PAYPAL_FALSE = '0',
        PAYPAL_TRUE = '1';

    /**
     * @return mixed
     * @todo 4 debug
     */
    public function payDebug()
    {
        Config::set(RETURN_TYPE_DEFAULT, 'html');

        $this->assign([
            //'option_list' => [
            //    'quantity',
            //    'item_number',
            //    'shipping',
            //    'shipping2',
            //    'handling',
            //    'tax',
            //
            //    'no_shipping',
            //
            //    'cn',
            //    'no_note',
            //
            //    'on0',
            //    'os0',
            //
            //    'on1',
            //    'os1',
            //
            //    'custom',
            //    'invoice',
            //
            //    'notify_url',
            //    'return',
            //    'cancel_return',
            //
            //    'image_url',
            //    'cs',
            //],

            // Required
            'business' => 'east.usa@fmnii.com',
            'item_name' => 'S Show Transaction',
            'currency_code' => 'USD',
            'amount' => 0.0,
            'btn_submit_img' => [
                'src' => 'https://www.paypal.com/zh_XC/i/btn/x-click-but01.gif',
                'alt' => 'Make payments with PayPal - it\'s fast, free and secure!',
            ],


            // TODO optional
            // Available variable list
            //'quantity' => 1,
            //'item_number' => '',
            //'shipping' => 0.0,
            //'shipping2' => 0.0,
            //'handling' => 0.0,
            //'tax' => 0,
            //
            //'no_shipping' => self::PAYPAL_FALSE,
            //
            'cn' => 'Under debug',
            //'no_note' => self::PAYPAL_FALSE,
            //
            //'on0' => '',
            //'os0' => '',
            //
            //'on1' => '',
            //'os1' => '',
            //
            //'custom' => null,
            //'invoice' => null,
            //
            //'notify_url' => '',
            //'return' => '',
            //'cancel_return' => '',
            //
            'image_url' => 'https://ss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/img/logo/bd_logo1_31bdc765.png', // TODO: 4 debug
            //'cs' => self::PAYPAL_FALSE,


            // Configuration
            'var_more' => false,
            'cmd_cart' => false,


            'email' => '',

            'first_name' => '',
            'last_name' => '',

            'address1' => '',
            'address2' => '',
            'city' => '',
            'state' => '',
            'zip' => null,

            'night_phone_a' => 0,
            'night_phone_b' => 0,

            'day_phone_a' => 0,
            'day_phone_b' => 0,


            'list_item' => [
                [
                    'item_name' => '',
                    'item_number' => '',
                    'amount' => 0.0,
                    'shipping' => 0.0,
                    'shipping2' => 0.0,
                    'handling' => 0.0,

                    'on0' => '',
                    'os0' => '',

                    'on1' => '',
                    'os1' => '',
                ],
            ],

        ]);

        return $this->display('_tmp/payment');
    }

    public function listMember($page = 1, $rowMax = null)
    {
        self::setHeaders();
        $data = Db::name('member')->page($page, $rowMax)->select();

        return self::retTemp(self::$scOK, 'OK', $data);
    }

    //endregion
}

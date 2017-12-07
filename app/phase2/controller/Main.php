<?php
/**
 * @copyright since 9:49 6/12/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\phase2\controller;

use app\phase2\model\Common;

// TODO
use think\Request;
use think\Config;
use think\Env;

/**
 * Class Main
 * @package app\phase2\controller
 * @todo app/phase2/view/main/nav.tpl
 */
class Main extends SignedController
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
     * @return mixed
     * @todo Password demo
     */
    public function debug()
    {
        //return Env::get('database.//username');

        // TODO: 255 for password storage, <= 72 chars
        $passwordOptionList = [
            'cost' => 8,
        ];
        $passwordHashed = password_hash('password', PASSWORD_DEFAULT, $passwordOptionList);
        if ($passwordHashed === false) {
            throw new \Exception('Password too long? (Max. <= 72 chars)');
        } elseif ($passwordHashed) {
            if (password_needs_rehash($passwordHashed, PASSWORD_DEFAULT)) {
                $newHash = password_hash('password', PASSWORD_DEFAULT); // TODO: new hash
            }
            return json([
                $passwordHashed,
                password_get_info($passwordHashed),
                password_verify('password', $passwordHashed),
            ]);
        } else {
            return false;
        }
    }

    /**
     * @return \think\response\View
     * @todo
     * @see app/phase2/view/main/_debug.tpl
     */
    public function main()
    {
        $this->assign([
            'welcome' => Common::WELCOME_INFORMATION,
        ]);
        return view();
    }

    //endregion
}

<?php
/**
 * @copyright since 14:58 4/12/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\common\model;

class Common
{
    const WELCOME_INFORMATION = '
<style type="text/css">
* {padding: 0; margin: 0;}
div {padding: 4px 48px;}
a {color: #2E5CD5; cursor: pointer; text-decoration: none;}
a:hover {text-decoration: underline;}
body {background: #fff; font-family: "Century Gothic", "Microsoft yahei", sans-serif; color: #333; font-size: 18px;}
h1 {font-size: 100px; font-weight: normal; margin-bottom: 12px; }
p {line-height: 1.6em; font-size: 42px}
</style>
<div style="padding: 24px 48px;"><h1>:)</h1> S Show API, phase 2</div>';

    /**
     * Encrypt password.
     * @param $original
     * @return bool|string
     */
    public static function encryptPassword($original)
    {
        return password_hash($original, PASSWORD_DEFAULT, ['cost' => 8]);
    }
}

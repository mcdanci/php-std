<?php
/**
 * @copyright since 14:58 4/12/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\common\model;

use McDanci\ThinkPHP\Config;
use McDanci\ThinkPHP\Request;

class Common
{
    const INFO_WELCOME = '<style type="text/css">
* {padding: 0; margin: 0;}
div {padding: 4px 48px;}
a {color: #2E5CD5; cursor: pointer; text-decoration: none;}
a:hover {text-decoration: underline;}
body {background: #fff; font-family: "Century Gothic", "Microsoft yahei", sans-serif; color: #333; font-size: 18px;}
h1 {font-size: 100px; font-weight: normal; margin-bottom: 12px; }
p {line-height: 1.6em; font-size: 42px}
</style>
<div style="padding: 24px 48px;"><h1>:)</h1> S Show API, phase 2</div>';

    public static function getInfoWelcomeMain()
    {
        return '<html>
<head>
<style type="text/css"><!--
* {padding: 0; margin: 0;}
.think_default_text {padding: 4px 48px;}
a {color: #2E5CD5; cursor: pointer; text-decoration: none;}
a:hover {text-decoration: underline;}
body {background: #fff; font-family: "Century Gothic", "Microsoft YaHei", sans-serif; color: #333; font-size: 18px}
h1 {font-size: 100px; font-weight: normal; margin-bottom: 12px;}
p {line-height: 1.6em; font-size: 42px}
--></style>
<title>' . Config::get('name') . '</title>
</head>

<body>
<div style="padding: 24px 48px;">
<h1>Welcome</h1>
<p>to :-) ' . Config::get('name') . '</p>
</div>

<div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 小正方形 -->
<ins class="adsbygoogle"
     style="display: inline-block; width: 200px; height: 200px;"
     data-ad-client="ca-pub-2277931214379968"
     data-ad-slot="5522321905"></ins>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
</body>
</html>';
    }

    /**
     * Encrypt password.
     * @param $original
     * @return bool|string
     */
    public static function encryptPassword($original)
    {
        return password_hash($original, PASSWORD_DEFAULT, ['cost' => 8]);
    }

    //region Paging

    const PARAM_BODY_ROW_MAX = 'per_page';

    /**
     * Get param. of body row maximum.
     * @return null
     */
    public static function getBRowMax()
    {
        return Request::instance()->param(self::PARAM_BODY_ROW_MAX . '/d') ?: null;
    }

    //endregion
}

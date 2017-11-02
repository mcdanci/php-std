<?php
namespace app\index\controller;

use think\Controller;

/**
 * S Show API Pages
 * @package app\index\controller
 */
class Index extends Controller
{
    /**
     * Welcome
     * @return string Welcome information
     */
    public function index()
    {
        return '
<html>
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
<title>S Show API</title>
</head>

<body>
<div style="padding: 24px 48px;">
    <h1>:) Welcome</h1>
    <p>S Show API</p>
</div>
</body>
</html>';
    }
}

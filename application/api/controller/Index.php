<?php
/**
 * @copyright since 10:53 20/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

use think\Controller;

class Index extends Controller
{
    /**
     * 跨域 header
     * @param false|string $domainName 可信域
     */
    protected static function setHeaders($domainName = false)
    {
        // 限定式跨域
        if ($domainName) {
            header('Access-Control-Allow-Origin: ' . $domainName);
            header('Access-Control-Allow-Credentials: true'); // 存取许可
        } else {
            header('Access-Control-Allow-Origin: *');
        }

        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Max-Age: 3628800'); // TODO
    }

    public function index()
    {
        return 'S Show Server';
    }

    public function listIso3166()
    {
        $data = (new \League\ISO3166\ISO3166)->all();

        foreach ($data as &$area) {
            unset($area['alpha2'], $area['alpha3'], $area['currency']);
        }

        return $data;
    }

    protected function _initialize()
    {
        self::setHeaders();
    }
}

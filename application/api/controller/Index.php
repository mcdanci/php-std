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
     * @param string $domainName 可信域，当且仅当「限定式跨域」时指定
     */
    protected static function setHeaders($domainName = '*')
    {
        static $methodList = [
            'GET',
            'POST',
            'PUT',
            'DELETE',
        ];
        static $time = 3628800;

        header('Access-Control-Allow-Origin: ' . $domainName);
        if ($domainName != '*') {
            header('Access-Control-Allow-Credentials: true'); // TODO: 存取许可
        }

        $methodString = implode(', ', $methodList);
        header('Access-Control-Allow-Methods: ' . $methodString); // TODO
        header('Access-Control-Max-Age: ' . $time); // TODO
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
        parent::_initialize();
        self::setHeaders();
    }
}

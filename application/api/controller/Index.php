<?php
/**
 * @copyright since 10:53 20/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

class Index extends Controller
{
    /**
     * S Show Server Example
     * @return array
     * @return int $-status
     * @return string $-info
     * @return string $-body
     */
    public function index()
    {
        return [
            'status' => 200,
            'info' => 'OK',
            'body' => 'S Show Server',
        ];
    }

    /**
     * 获取 ISO 3166 清单
     * @return array
     * @return int $-status
     * @return string $-info
     * @return array $-body
     * @return array $-- tuple
     * @return array $--name
     * @return array $--numeric
     */
    public function listIso3166()
    {
        $data = (new \League\ISO3166\ISO3166)->all();

        foreach ($data as &$area) {
            unset($area['alpha2'], $area['alpha3'], $area['currency']);
        }

        return [
            'status' => 200,
            'info' => 'OK',
            'body' => $data,
        ];
    }
}

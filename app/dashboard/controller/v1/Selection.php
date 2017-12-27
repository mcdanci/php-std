<?php
/**
 * @copyright since 15:38 26/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\Booth;
use app\common\model\Common;
use McDanci\ThinkPHP\Request;
use think\Db;

class Selection extends SignedController
{
    /**
     * @return array|\think\Response
     * @throws \Exception
     * @todo
     */
    public function main()
    {
        return self::retTemp(self::$scOK, null, [
            'map' => 'https://s-show.fmnii.e13.cc/asset/img/map-stereoscopic.svg',
            'map_mini' => 'https://s-show.fmnii.e13.cc/asset/img/map-stereoscopic.svg',
            'category_list' => [
                'zone' => [],
                'type' => [],
            ],
            [
                'title',
                'about',
                'description', // company desc?
                'cat' => ['zone', 'type'],
                'thumbnail' => [], // company image
            ], // For response of visitor tuple
        ]);
    }

    /**
     * 列出可选的展位。
     * @param null|int $type 展位类型 {1 ~ 5} TODO: 后端进行 IDX 转换
     * @param null|int $zone 展区 {1 ~ 8}
     * @param null|int $id
     * @return array|\think\Response
     * @throws \Exception
     */
    public function listBooth($type = null, $zone = null, $id = null)
    {
        $cond = [];
        $booth = new Booth();

        $input = [
            'type' => $this->request->param('type/d') ?: null,
            'zone' => $this->request->param('zone/d') ?: null,
            'id' => $this->request->param('id/s') ?: null,
        ];

        foreach (['type', 'zone'] as &$searchItem) {
            $methodRangeGetterName = 'getRange' . $searchItem;

            if ($input[$searchItem] !== null && in_array($input[$searchItem], $booth::$methodRangeGetterName())) {
                $cond[$searchItem] = $input[$searchItem];
            }
        }
        if ($input['id'] !== null) {
            $cond['id'] = $input['id'];
        }
        if (!count($cond)) {
            $cond = true;
        }

        $result = $booth->field(true)->where($cond)->paginate(Common::getBRowMax());

        return self::retTemp(self::$scOK, null, $result->toArray());
    }

    /**
     * 展位选定。
     * @param null|int $reg_id 登记人 id
     * @param null|int $type {1: 最小展位单元, 2: 组合}
     * @param null $opt 传入的资料，依 `$type` 而不同 TODO
     */
    public function select($reg_id = null, $type = null, $opt = null)
    {
        $data = ['reg_id' => $reg_id, 'type' => $type, 'opt' => $opt];
        return self::retTemp(self::$scOK, null, [
            'result' => Db::name('debug')->insert([
                'k' => 'booth_selection',
                'body' => json_encode($data),
            ]),
            'original_data' => $data,
            'original_opt' => json_decode($data['opt']),
        ]);
    }
}

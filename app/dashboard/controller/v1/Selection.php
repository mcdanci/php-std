<?php
/**
 * @copyright since 15:38 26/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\Booth;
use app\common\model\Common;
use McDanci\ThinkPHP\Config;
use McDanci\ThinkPHP\Request;
use think\Db;
use app\common\model;
use function time;

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
            $methodRangeGetterName = 'getRange' . ucfirst($searchItem);

            if ($input[$searchItem] !== null && in_array($input[$searchItem], $booth::$methodRangeGetterName())) {
                $cond[$searchItem] = ($searchItem == 'type') ? $input[$searchItem] - 1 : $input[$searchItem];
            }
        }
        if ($input['id'] !== null) {
            $cond['id'] = $input['id'];
        }
        if (!count($cond)) {
            $cond = true;
        }

        $result = $booth->field(true)->where($cond)->paginate(Common::getBRowMax());

        $resultArr = $result->toArray();
        foreach ($resultArr['data'] as &$booth) {
            $booth['number'] = $booth['zone'] . str_pad($booth['id'], 3, 0, STR_PAD_LEFT);
        }

        return self::retTemp(self::$scOK, null, $resultArr);
    }

    /**
     * 展位选定。
     * @param null|int $reg_id 登记人 ID *optional*
     * @param null|int $type 类型 {1: 单个最小展位单元选定, 2: 多个最小展位单元组合选定}
     * @param null|string $opt 传入的资料，依 `$type` 而不同 TODO
     * @return array|\think\Response
     * @todo $reg_id
     */
    public function select($reg_id = null, $type = null, $opt = null)
    {
        $this->regId = $this->regId ?: $reg_id;
        if (!$this->regId) {
            return self::retTemp(self::$scNotFound, 'Registrant ID could not be empty');
        }

        if ($order = model\Order::get(['reg_id' => $this->regId])) {
            // TODO: update?
        } else {
            $data = [
                'reg_id' => $this->regId,
                //'exhibitor_pay_deadline' => date(
                //    self::$formatMySQLDatetime,
                //    time() + 60 * Config::get('exhibitor_pay_deadline_in_min')
                //),
                'amount' => 0.01, // TODO
            ];

            $order = new model\Order($data);
            $order->isExhibitor = true;
            $result = $order->save();

            if ($result) {
                Db::name('debug')->insert([
                    'k' => 'booth_selection',
                    'body' => json_encode($data),
                ]); // TODO
                return self::retTemp(self::$scOK, null, [
                    'result' => $result,
                    'data_original' => $data,
                    ]);
            } else {
                return self::retTemp(self::$scNotFound, null, [
                    'data' => $data,
                    'opt' => json_decode(htmlspecialchars_decode($opt), true) ?: [], // TODO, together
                    'type' => $type, // TODO
                ]);
            }
        }

        return self::retTemp(self::$scNotFound);
    }
}

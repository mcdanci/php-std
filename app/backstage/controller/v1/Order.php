<?php
/**
 * @copyright since 11:11 28/12/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use app\common\model;
use McDanci\ThinkPHP\Phinx;

class Order extends Controller
{
    /**
     * @param null $type
     * @param null $status
     * @param null $search
     * @return array|\think\Response
     * @todo 筛选、搜索
     */
    public function main($type = null, $status = null, $search = null)
    {
        $cond = [];
        $order = new model\Order();

        $input = [
            'type' => $this->request->param('type/d') ?: null,
            'status' => $this->request->param('status/d') ?: null,
            'search' => $this->request->param('search/s') ?: null,
        ];

        //foreach (['status', 'type'] as &$searchItem) {
        //    $methodRangeGetterName = 'getRange' . $searchItem;
        //
        //    if ($input[$searchItem] !== null && in_array($input[$searchItem], Reg::$methodRangeGetterName())) {
        //        $cond[$searchItem] = $input[$searchItem];
        //    }
        //}
        //if ($input['search'] !== null) {
        //    $cond[implode('|', ['email', 'name_first', 'name_last'])] = ['like', '%' . $input['search'] . '%'];
        //}
        if (!count($cond)) {
            $cond = true;
        }

        $result = $order->with('reg')->field(
            //[
            //    'id',
            //    'created',
            //    'email',
            //    'type',
            //    'company',
            //    'city',
            //    'status',
            //]
            true
        )
            ->where($cond)
            ->order(['id' => $order::ORDER_DESC])
            ->paginate(model\Common::getBRowMax());

        return self::retTemp(self::$scOK, null, $result->toArray());
    }
}

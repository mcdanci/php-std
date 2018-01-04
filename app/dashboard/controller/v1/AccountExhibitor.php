<?php
/**
 * @copyright since 16:05 4/1/2018
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model\RegExhibitorStaff;
use McDanci\ThinkPHP\Config;

class AccountExhibitor extends Account
{
    //region Staff

    protected $staff;

    public function listStaff()
    {
        $staffList = RegExhibitorStaff::all(['order_id' => $orderId = $this->reg->tableOrder->id]);

        if ($staffList) {
            return self::retTemp(self::$scOK, null, $staffList);
        }

        return self::retTemp(self::$scNotFound, 'Something wrong');
    }

    /**
     * @param string $email
     * @param string $position
     * @param string $name_full
     * @return array|\think\Response
     */
    public function createStaff($email = null, $position = null, $name_full = null)
    {
        /**
         * @todo
         */
        //$staff = new RegExhibitorStaff([
        //    'order_id' => 1,
        //    //'offset' => 1,
        //]);
        //$result = $staff->save();

        try {
            self::checkInputString($email, 'email');
            self::checkInputString($position, 'position');
            self::checkInputString($name_full, 'full name');
        } catch (\RuntimeException $exception) {
            return self::retTemp(self::$scNotFound, $exception->getMessage());
        }

        $this->staff = new RegExhibitorStaff();
        $count = $this->staff->where(['order_id' => 1])->count();

        if ($count >= Config::get('exhibitor_staff_count_max')) {
            return self::retTemp(self::$scNotFound, 'Full now');
        } elseif ($this->reg && $this->reg->toArray()['type'] == 'exhibitor') {
            $orderId = $this->reg->tableOrder->id;

            $this->staff = new RegExhibitorStaff([
                'order_id' => $orderId,
                'offset' => $this->staff->where(['order_id' => $orderId])->count(),
                'email' => $email,
                'position' => $position,
                'name_full' => $name_full,
            ]);
            $result = $this->staff->save();

            if ($result) {
                return self::retTemp(self::$scOK, null, $this->staff->toArray());
            }
        }

        return self::retTemp(self::$scNotFound, 'Something wrong');
    }

    //endregion
}

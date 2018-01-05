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

    /**
     * @var null|RegExhibitorStaff
     */
    protected $staff;

    /**
     * List staff.
     * @return array|\think\Response
     */
    public function listStaff()
    {
        $staffList = RegExhibitorStaff::all(['order_id' => $orderId = $this->reg->tableOrder->id]);

        if ($staffList) {
            return self::retTemp(self::$scOK, null, $staffList);
        } else {
            return self::retTemp(self::$scNotFound, 'No staff registered');
        }
    }

    /**
     * New staff.
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

            $offsetMax = RegExhibitorStaff::withTrashed()
                ->where(['order_id' => $orderId])
                ->order(['offset' => $this->staff::ORDER_DESC])
                ->value('offset');
            $offsetMax = $count ? $offsetMax + 1 : 0;

            $this->staff = new RegExhibitorStaff([
                'order_id' => $orderId,
                'offset' => $offsetMax,
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

    /**
     * Edit staff.
     * @param int $offset
     * @param string $email
     * @param string $position
     * @param string $name_full
     * @return array|\think\Response
     * @todo run
     * @todo 是否應限定增加、修訂同刪除的最後期限
     */
    public function edit($offset = null, $position = null, $name_full = null)
    {
        try {
            self::checkInputString($offset, 'offset');
            self::checkInputString($position, 'position');
            self::checkInputString($name_full, 'full name');
        } catch (\RuntimeException $exception) {
            return self::retTemp(self::$scNotFound, $exception->getMessage());
        }

        if ($this->reg && $offset) {
            $this->staff = RegExhibitorStaff::get([
                'order_id' => $this->reg->tableOrder->id,
                'offset' => $offset,
            ]);

            $this->staff->position = $position;
            $this->staff->name_full = $name_full;

            $result = $this->staff->save();
            if ($result) {
                return self::retTemp();
            }
        }

        return self::retTemp(self::$scNotFound, 'Something wrong');
    }

    /**
     * Delete staff.
     * @param null $offset
     * @return array|\think\Response
     * @todo email
     */
    public function deleteStaff($offset = null)
    {
        try {
            self::checkInputString($offset, 'offset');
        } catch (\RuntimeException $exception) {
            return self::retTemp(self::$scNotFound, $exception->getMessage());
        }

        if ($this->reg && $offset) {
            $this->staff = RegExhibitorStaff::get([
                'order_id' => $this->reg->tableOrder->id,
                'offset' => $offset,
            ]);
            $result = $this->staff->delete();
            if ($result) {
                return self::retTemp();
            }
        }

        return self::retTemp(self::$scNotFound, 'Something wrong');
    }

    //endregion
}

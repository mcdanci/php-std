<?php
namespace app\common\model;

/**
 * Class Booth
 * @package app\common\model
 */
class Booth extends Model
{
    //region Configuration

    protected $readonly = [
        // TODO
    ];

    public $appendNumber = true;

    //region Attribute

    //region Zone

    public function setZoneAttr($value)
    {
        return Helper::getIdByA(mb_strtoupper($value));
    }

    public function getZoneAttr($value)
    {
        return Helper::getAById($value);
    }

    public function getNumberAttr($value, $data)
    {
        return $this->getAttr('zone') . str_pad($data['id'], 3, 0, STR_PAD_LEFT);
    }

    //endregion

    //endregion

    //endregion

    /**
     * @param null $data
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function select($data = null)
    {
        $resultSet = parent::select($data);
        if ($this->appendNumber && $resultSet) {
            foreach ($resultSet as &$resultTuple) {
                $resultTuple['number'] = $resultTuple['zone'] . str_pad($resultTuple['id'], 3, 0, STR_PAD_LEFT);
            }
        }

        return $resultSet;
    }
}

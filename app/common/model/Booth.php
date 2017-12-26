<?php
namespace app\common\model;

use McDanci\ThinkPHP\Config;

/**
 * Class Booth
 * @package app\common\model
 */
class Booth extends Model
{
    /**
     * @todo
     */
    public function getRangeType()
    {
    }

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

    //region Type

    public function getTypeAttr($value)
    {
        $map = Config::get('booth_type');

        if ($this->appendType) {
            foreach ($map as $key => &$item) {
                if (!is_null($item)) {
                    $item['value'] = $key + 1;
                }
            }
        }

        return array_key_exists($value, $map) ? $map[$value] : null;
    }

    //endregion

    //region Is Courtyard

    private static $mapAttrIsCourtyard = [
        null => false,
        1 => true,
    ];

    public function getIsCourtyardAttr($value)
    {
        return self::$mapAttrIsCourtyard[$value];
    }

    //endregion

    public $appendType = true;

    //endregion

    //endregion

    //region Common

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

    //endregion
}

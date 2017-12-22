<?php
/**
 * @copyright since 17:46 14/12/2017
 * @author <mc@dancis.info>
 */
namespace app\common\model;

use McDanci\ThinkPHP\Config;
use McDanci\ThinkPHP\Model;
use traits\model\SoftDelete;

/**
 * Class Reg
 * @package app\common\model
 * @method static \app\common\model\Reg getByStatus(int $status)
 */
class Reg extends Model
{
    use SoftDelete;

    //region Configuration

    protected
        $autoWriteTimestamp = 'datetime',
        $createTime = 'created',
        $updateTime = false,
        $deleteTime = 'deleted';

    protected $readonly = [
        'created',

        'type',
        'name_first',
        'name_last',
        'gender',
        'email',
        'tel',
        'tel_cell',
        'company',
        'street',
        'city',
        'state',
        'zip',
        'iso3166',
        'website',
        'cat',
        'password',
    ];

    //endregion

    //region Relation

    private static function bindCN($name, $roleType = 1)
    {
        if (in_array($roleType, [1,2])) {
            return ($roleType === 1 ? 'exhibitor' : 'visitor') . '_' . $name;
        }

        return false;
    }

    private static function bindMap(&$bindList, $roleType = 1)
    {
        $bind = [];
        foreach ($bindList as &$bindColumn) {
            $bind[self::bindCN($bindColumn, $roleType)] = $bindColumn;
        }
        $bindList = $bind;
    }

    public function regExhibitor()
    {
        $bindList = [
            'c_opf',
            'mpt',
            'npe',
            'mc',
            'tse',
        ];

        self::bindMap($bindList);
        return $this->hasOne('RegExhibitor')->bind($bindList);
    }

    public function regVisitor()
    {
        $bindList = [
            'job_function',
            'brand',
            'f_man',
        ];

        self::bindMap($bindList, 2);
        return $this->hasOne('RegVisitor')->bind($bindList);
    }

    //endregion

    //region Attr. configuration

    //region Type

    private static $mapAttrType = [
        null,
        'exhibitor',
        'visitor',
        'admin',
    ];

    public static function getRangeType()
    {
        return array_keys(self::$mapAttrType);
    }

    public function setTypeAttr($value)
    {
        return array_search($value, self::$mapAttrType, true);
    }

    /**
     * Getter for type of role.
     * @param $value
     * @return mixed
     */
    public function getTypeAttr($value)
    {
        return self::$mapAttrType[$value];
    }

    //endregion

    //region Gender

    private static $mapAttrGender = [
        null,
        'Mrs.',
        'Mr.',
        'Ms.',
    ];

    public function setGenderAttr($value)
    {
        return array_search($value, self::$mapAttrGender);
    }

    public function getGenderAttr($value)
    {
        return self::$mapAttrGender[$value];
    }

    //endregion

    //region Status

    const
        STATUS_UNAUDITED = 1,
        STATUS_PASSED = 2,
        STATUS_DECLINED = 3;

    public static $mapAttrStatus = [
        self::STATUS_UNAUDITED => 'unaudited',
        self::STATUS_PASSED => 'passed',
        self::STATUS_DECLINED => 'declined',
    ];

    public static function getRangeStatus()
    {
        return array_keys(self::$mapAttrStatus);
    }

    public function setStatusAttr($value)
    {
        return array_search($value, self::$mapAttrStatus);
    }

    public function getStatusAttr($value)
    {
        return self::$mapAttrStatus[$value];
    }

    //endregion

    //endregion

    /**
     * @todo
     */
    protected static function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        Config::set('');
    }

    /**
     * @todo
     */
    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * @param $id
     * @todo
     */
    public function auditPass($id)
    {
        //self::destroy('');
        //self::delete('');
    }
}

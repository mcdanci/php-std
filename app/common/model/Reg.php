<?php
/**
 * @copyright since 17:46 14/12/2017
 * @author <mc@dancis.info>
 */
namespace app\common\model;

use League\ISO3166\ISO3166;
use McDanci\ThinkPHP\Config;
use traits\model\SoftDelete;

/**
 * Class Reg
 * @package app\common\model
 * @method static \app\common\model\Reg getByStatus(int $status)
 */
class Reg extends Model
{
    use SoftDelete;

    const AGREEMENT_UNREAD = 1, AGREEMENT_READ = 2;

    //region Configuration

    protected
        $autoWriteTimestamp = 'datetime',
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
        //'password', // TODO
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

    //region Attribute

    //region ISO 3166

    /** Getter for country code in ISO 3166
     * @param $value
     * @return array
     * @todo 臺灣
     */
    public function getIso3166Attr($value)
    {
        return (new ISO3166())->numeric(str_pad($value, 3, 0, STR_PAD_LEFT))['name'] ?: 'Unknown';
    }

    //endregion

    //region Type

    const
        TYPE_EXHIBITOR = 1,
        TYPE_VISITOR = 2;
    const TYPE_ADMIN = 3;

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

    //region Reason

    /**
     * @var array
     * @todo 可見性，繼續封裝
     */
    public static $mapAttrReason = [
        'exhibitor' => [
            'Your business is not clear to fit the exhibitor profile. Please send relevant document(s) to support your application.'
        ],
        'visitor' => [
            'Unidentified information (Please upload picture of your business card to support our verification).',
            'The email address domain name does not match company website domain name.',
            'Please provide additional relevant document(s) if your identity falls under the visitor profile http://www.sourcethefuture.cc/visitorprofile/.',
        ],
    ];

    public function getReasonAttr($value)
    {
        return $value; // TODO
    }

    //endregion

    //region Category

    public function getCatAttr($value, $data)
    {
        if (array_key_exists('type', $data)) {
            $exCat = Config::get('ex_cat');

            switch ($data['type']) {
                case self::TYPE_EXHIBITOR:
                    $value = $exCat[$value - 1];
                    break;
                case self::TYPE_VISITOR:
                    $value = explode(',', $value);
                    foreach ($value as &$cat) {
                        $cat = $exCat[$cat - 1];
                    }
                    break;
            }
        }
        return $value;
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

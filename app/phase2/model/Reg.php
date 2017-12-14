<?php
namespace app\phase2\model;

use think\Loader;
use think\Model;
use traits\model\SoftDelete;

class Reg extends Model
{
    use SoftDelete;

    protected static $deleteTime = 'deleted';

    protected
        $autoWriteTimestamp = 'datetime',
        $createTime = 'created',
        $updateTime = false;

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

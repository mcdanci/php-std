<?php
namespace app\common\model;

use think\Model;

class RegExhibitor extends Model
{
    public function reg()
    {
        return $this->belongsTo('Reg');
    }
}

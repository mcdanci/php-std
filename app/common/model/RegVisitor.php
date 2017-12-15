<?php
namespace app\common\model;

use think\Model;

class RegVisitor extends Model
{
    public function reg()
    {
        return $this->belongsTo('Reg');
    }
}

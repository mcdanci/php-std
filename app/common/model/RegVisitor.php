<?php
namespace app\common\model;

class RegVisitor extends Model
{
    public function reg()
    {
        return $this->belongsTo('Reg');
    }
}

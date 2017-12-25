<?php
namespace app\common\model;

class RegExhibitor extends Model
{
    public function reg()
    {
        return $this->belongsTo('Reg');
    }
}

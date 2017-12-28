<?php
namespace app\common\model;

class OrderExhibitorBooth extends Model
{
    public function tableOrder()
    {
        return $this->belongsTo('Order');
    }
}

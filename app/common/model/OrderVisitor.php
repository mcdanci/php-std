<?php
namespace app\common\model;

/**
 * Class OrderVisitor
 * @package app\common\model
 * @todo
 */
class OrderVisitor extends Model
{
    //region Attribute

    const
        TICKET_TYPE_SINGLE = 1,
        TICKET_TYPE_BOTH = 2;

    public static $mapAttrTicketType = [
        // TODO
        //self::TICKET_TYPE_SINGLE => 'single',
        //self::TICKET_TYPE_BOTH => 'both',
        self::TICKET_TYPE_SINGLE => 'per day',
        self::TICKET_TYPE_BOTH => 'two days',
    ];

    public static function getRangeTicketType()
    {
        return array_keys(self::$mapAttrTicketType);
    }

    public static function getFee($ticketType)
    {
        static $MAP = [
            self::TICKET_TYPE_SINGLE => 50,
            self::TICKET_TYPE_BOTH => 75,
        ];

        if (in_array($ticketType, self::getRangeTicketType())) {
            return $MAP[$ticketType];
        } else {
            return false; // TODO: exception
        }
    }

    //endregion

    //region Relation

    public function tableOrder()
    {
        return $this->belongsTo('Order');
    }

    //endregion
}

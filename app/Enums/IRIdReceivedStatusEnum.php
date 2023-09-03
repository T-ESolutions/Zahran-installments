<?php

namespace App\Enums;

enum IRIdReceivedStatusEnum: int
{
    case RECEIVED = 1;
    case  WAITING = 2;
    case  WITHOUT_ID = 3;


    public static  function getStatusText($status) :string
    {
        return match ($status) {
            self::RECEIVED->value => 'received',
            self::WAITING->value => 'waiting',
            self::WITHOUT_ID->value => 'without id',
         };
    }

}

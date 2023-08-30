<?php

namespace App\Enums;

enum BlockEnum: int
{
    case BLOCKED = 1;
    case  UNBLOCKED = 0;


    public static  function getActiveText($status) :string
    {
        return match ($status) {
            self::BLOCKED->value => 'blocked',
            self::UNBLOCKED->value => 'unblocked',
         };
    }

}

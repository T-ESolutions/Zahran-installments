<?php

namespace App\Enums;

enum ActiveEnum: int
{
    case ACTIVE = 1;
    case  INACTIVE = 0;


    public static  function getActiveText($status) :string
    {
        return match ($status) {
            self::ACTIVE->value => 'active',
            self::INACTIVE->value => 'inactive',
         };
    }

}

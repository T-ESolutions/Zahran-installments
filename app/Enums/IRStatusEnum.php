<?php

namespace App\Enums;

enum IRStatusEnum: int
{
    case PENDING = 1;
    case  APPROVED = 2;
    case  REJECTED = 3;


    public static  function getStatusText($status) :string
    {
        return match ($status) {
            self::PENDING->value => __('lang.pending'),
            self::APPROVED->value => __('lang.approved'),
            self::REJECTED->value => __('lang.rejected'),
         };
    }

}

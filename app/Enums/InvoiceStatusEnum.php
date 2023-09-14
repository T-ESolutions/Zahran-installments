<?php

namespace App\Enums;

enum InvoiceStatusEnum: int
{
    case PENDING = 1;
    case  STARTED = 2;
    case  FINISHED = 3;


    public static  function getStatusText($status) :string
    {
        return match ($status) {
            self::PENDING->value => __('lang.pending'),
            self::STARTED->value => __('lang.started'),
            self::FINISHED->value => __('lang.finished'),
         };
    }

}

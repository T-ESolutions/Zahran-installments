<?php

namespace App\Enums;

enum InvoiceStatusEnum: int
{
    case PENDING = 1;
    case  STARTED = 2;
    case  FINISHED = 3;
    case  execution = 4;


    public static  function getStatusText($status) :string
    {
        return match ($status) {
            self::PENDING->value => __('lang.invoice_status_1'),
            self::STARTED->value => __('lang.invoice_status_2'),
            self::FINISHED->value => __('lang.invoice_status_3'),
            self::execution->value => __('lang.invoice_status_4'),
         };
    }

}

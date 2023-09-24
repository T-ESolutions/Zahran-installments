<?php

namespace App\Enums;

enum InvoiceInstallmentsStatusEnum: int
{
    case PAID = 1;
    case  UNPAID = 2;



    public static  function getStatusText($status) :string
    {
        return match ($status) {
            self::PAID->value => __('lang.paid'),
            self::UNPAID->value => __('lang.unpaid'),
         };
    }



}

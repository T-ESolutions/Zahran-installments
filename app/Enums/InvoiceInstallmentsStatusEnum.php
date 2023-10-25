<?php

namespace App\Enums;

enum InvoiceInstallmentsStatusEnum: int
{
    case PAID = 1;
    case  UNPAID = 2;
    case LATE = 3;
    case not_yet = 4; // لم يحن الوقت بعد
    case inprocess = 5; // ساري
    case delayed = 6; // مؤجل
    case deported = 7; // مرحل





    public static  function getStatusText($status) :string
    {
        return match ($status) {
            self::PAID->value => __('lang.paid'),
            self::UNPAID->value =>  'لم يحن الوقت بعد',
            self::LATE->value => __('lang.late'),
            self::not_yet->value => 'لم يحن الوقت بعد',
            self::inprocess->value => 'ساري',
            self::delayed->value => 'مؤجل',
            self::deported->value => 'مرحل',
         };
    }



}

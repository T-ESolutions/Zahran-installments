<?php

namespace App\Enums;

enum InvoiceTypeEnum: int
{
    case INSURANCE  = 1;
    case  ATTORNEY = 2;
    case  INVOICE = 3;


    public static  function getActiveText($status) :string
    {
        return match ($status) {
            self::INSURANCE->value => 'insurance',
            self::ATTORNEY->value => 'attorney',
            self::INVOICE->value => 'invoice',
         };
    }

}

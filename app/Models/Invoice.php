<?php

namespace App\Models;

use App\Enums\InvoiceInstallmentsStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['transaction_number'];

    public function getRelations()
    {
        return [];
    }

    /**
     * START CASTING
     */


    /**
     * ***************************************************************************************
     */
    /**
     * START MUTATOR
     */


    public function getTransactionNumberAttribute()
    {

        return $this->pay_day . '.' . $this->customer->id;
    }





    /**
     * ***************************************************************************************
     */
    /**
     * START SCOPES
     */


    /**
     * ***************************************************************************************
     */
    /**
     * START METHODS
     */


    /**
     * ***************************************************************************************
     */
    /**
     * START RELATIONS
     */


    public function guarantors()
    {
        return $this->belongsToMany(Customer::class, 'customer_invoice', 'invoice_id', 'customer_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function installments()
    {
        return $this->hasMany(InvoiceInstallments::class, 'invoice_id');
    }

    public function unInstallments()
    {
        return $this->hasMany(InvoiceInstallments::class, 'invoice_id')
            ->where('pay_date','<=' , now() )
            ->where('status',InvoiceInstallmentsStatusEnum::UNPAID->value )

            ;
    }

}

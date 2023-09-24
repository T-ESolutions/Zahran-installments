<?php

namespace App\Models;

use App\Enums\InvoiceInstallmentsStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];



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
            ->where('status',InvoiceInstallmentsStatusEnum::UNPAID->value ) ;
    }



}

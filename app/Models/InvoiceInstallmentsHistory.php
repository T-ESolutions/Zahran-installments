<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceInstallmentsHistory extends Model
{
    protected $guarded=['id'];

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

    public function invoiceInstallment()
    {
        return $this->belongsTo(InvoiceInstallments::class, 'invoice_installment_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }



}

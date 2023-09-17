<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
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


    public function guarantors(){
        return $this->belongsToMany(Customer::class, 'customer_invoice','invoice_id','customer_id');
    }

    public function installments()
    {
        return $this->hasMany(InvoiceInstallments::class, 'invoice_id');
    }

}

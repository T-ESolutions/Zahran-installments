<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentRequest extends Model
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
    protected $appends=['remaining_price'];
    public function getRemainingPriceAttribute()
    {
        return $this->price - $this->deposit;
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

    public function customers(){
        return $this->belongsToMany(Customer::class, 'customer_installment_requests','installment_request_id','customer_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }



}

<?php

namespace App\Models;

use App\Enums\LawsuitStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawsuit extends Model
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

        public function getStatusAttribute($value)
        {
           if ($value == LawsuitStatusEnum::UNPAID->value)
           {
                return __('lang.unpaid');
           }
              elseif ($value == LawsuitStatusEnum::PAID->value)
              {
                 return __('lang.paid');
              }
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
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }




}

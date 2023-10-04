<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyHistory extends Model
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
    public function created_by()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }




}

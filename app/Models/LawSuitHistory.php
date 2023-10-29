<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawSuitHistory extends Model
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


    public function getCreatedAtAttribute()
    {
        return date('Y-m-d h:m A', strtotime($this->attributes['created_at']));
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





}

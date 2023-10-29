<?php

namespace App\Models;

use App\Enums\BlockEnum;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Authenticatable
{
    use HasApiTokens;

    protected $guarded = ['id'];


    protected $hidden = ['password'];

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

    public function scopeWhiteList($query)
    {

        return $query->where('is_blocked', BlockEnum::UNBLOCKED->value);
        }




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
    public function relatives()
    {
        return $this->hasMany(CustomerRelatives::class, 'customer_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function laws()
    {
        return $this->hasManyThrough(Lawsuit::class, Invoice::class);
    }

}

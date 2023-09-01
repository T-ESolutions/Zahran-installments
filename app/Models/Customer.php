<?php

namespace App\Models;

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

   public function relatives()
   {
       return $this->hasMany(CustomerRelatives::class , 'customer_id');
   }

}

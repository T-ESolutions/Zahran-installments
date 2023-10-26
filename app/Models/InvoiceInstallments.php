<?php

namespace App\Models;

use App\Enums\InvoiceInstallmentsStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceInstallments extends Model
{
    protected $guarded = [''];

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


//    public function getStatusAttribute()
//    {
//
//        $status = $this->attributes['status'];
//
//        // check if pay_date less than today
//        if ($this->attributes['pay_date'] < now()->format('Y-m-d')) {
//            $status = InvoiceInstallmentsStatusEnum::LATE->value;
//        }
//
//        if ($this->attributes['paid_amount'] == $this->attributes['monthly_installment']) {
//            $status = InvoiceInstallmentsStatusEnum::PAID->value;
//        }
//
//
//        return InvoiceInstallmentsStatusEnum::getStatusText($status);
//    }



    public function getLateDaysAttribute()
    {
        $diff = 0;
        $model = InvoiceInstallments::where('id', $this->attributes['id'])->first();
if($model->status != 1 || $model->status != 7){
    if ($this->attributes['pay_date'] < now()->format('Y-m-d')) {

        $diff = now()->diffInDays($this->attributes['pay_date']);

        if ($model){
            $model->status = 3;
            $model->late_days = $diff;
            $model->save();
        }

        return $diff;
    }
}


        return $diff;
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


    public function history()
    {
        return $this->hasMany(InvoiceInstallmentsHistory::class, 'invoice_installments_id', 'id')->with('admin')->orderBy('id','desc');
    }


}

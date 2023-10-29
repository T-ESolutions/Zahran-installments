<?php

namespace App\Models;

use App\Enums\InvoiceInstallmentsStatusEnum;
use App\Enums\LawsuitStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];

    const INVOICE_TYPE = [1, 2, 3];

    const FINISHED = 3;

    protected $appends = ['remain_installments_price'];

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

    public function getRemainInstallmentsPriceAttribute()
    {
        $total_paid_amount = $this->installments->sum('paid_amount');
        $total_monthly_installment = $this->installments->sum('monthly_installment');
        return $total_monthly_installment - $total_paid_amount;
    }

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

    public function invoice()
    {
        return $this->belongsTo(self::class, 'invoice_id');
    }

    public function installments()
    {
        return $this->hasMany(InvoiceInstallments::class, 'invoice_id');
    }

    public function remain_installments()
    {
        return $this->hasMany(InvoiceInstallments::class, 'invoice_id')->whereIn('status', [2, 3, 4, 5, 6]);
    }


    public function unInstallments()
    {
        return $this->hasMany(InvoiceInstallments::class, 'invoice_id')
            ->where('pay_date', '<=', now())
            ->where('status', InvoiceInstallmentsStatusEnum::UNPAID->value ) ;
    }

    public function unPaidLawSuit()
    {
        return $this->hasMany(Lawsuit::class, 'invoice_id')
            ->where('status', LawsuitStatusEnum::UNPAID->value ) ;
    }

    public function lawSuit()
    {
        return $this->hasMany(Lawsuit::class, 'invoice_id');
    }

    public function papers()
    {
        return $this->hasMany(Paper::class, 'invoice_id');
    }


}

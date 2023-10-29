<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstallmentsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'invoice_id'=>$this->invoice_id ,
            'customer_name'=>$this->invoice->customer->name ,
            'id'=>$this->id ,
            'pay_date'=>$this->pay_date ,
            'monthly_installment'=>$this->monthly_installment ,
            'paid_amount'=>$this->paid_amount ,
            'status'=>trans('lang.status_'.$this->status) ,
            'moved_days'=>$this->moved_days ,
            'late_days'=>$this->late_days ,
            'notes'=>$this->notes ,
            'created_at'=>$this->created_at ,
        ];
    }
}

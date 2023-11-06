<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomersLateListExportResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $paid_amount =  $this->late_installments ? $this->late_installments->sum('paid_amount') : 0 ;
        $monthly_installment =  $this->late_installments ? $this->late_installments->sum('monthly_installment') : 0 ;
        $remain_amount =$monthly_installment - $paid_amount ;
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'lat_amount' => $remain_amount,

        ];
    }
}

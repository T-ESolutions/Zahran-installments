<?php

namespace App\Exports;

use App\Http\Resources\CustomerLawResources;
use App\Http\Resources\InstallmentsResources;
use App\Models\Customer;
use App\Models\InvoiceInstallments;
use Carbon\Carbon;
use Database\Seeders\CustomerSeeder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class CustomerLawExport implements FromCollection ,WithHeadings , WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [

            'اسم العميل',
            'رقم الهاتف',
            'عدد الدعاوى القضائية',
            'اجمالي المصاريف القضائية',

        ];
    }

    public function collection()
    {
        $data = Customer::whereHas('laws')->orderBy('created_at','asc')->get();
        return CustomerLawResources::collection($data);
    }
}

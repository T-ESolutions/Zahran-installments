<?php

namespace App\Exports;

use App\Http\Resources\CustomersLateListExportResources;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class CustomersLateListExport implements FromCollection ,WithHeadings , WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'اسم العميل',
            'رقم الهاتف',
            'المبلغ المتأخر',

        ];
    }

    public function collection()
    {
        return CustomersLateListExportResources::collection(Customer::where('is_late',1)->orderBy('created_at','desc')->get());
    }
}

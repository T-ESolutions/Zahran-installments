<?php

namespace App\Exports;

use App\Http\Resources\InstallmentsResources;
use App\Models\InvoiceInstallments;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class MonthInstallmentsExport implements FromCollection ,WithHeadings , WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'رقم الفاتورة',
            'اسم العميل',
            'رقم القسط',
            'يوم السداد',
            'القسط الشهري',
            'المبلغ المدفوع',
            'الحالة',
            'الايام المرحلة',
            'ايام التأخير',
            'ملاحظات',
            'أنشئت في',
        ];
    }

    public function collection()
    {
        return InstallmentsResources::collection(InvoiceInstallments::whereMonth('pay_date',Carbon::now()->month)->orderBy('created_at','asc')->get());
    }
}

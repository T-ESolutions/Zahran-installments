<?php

namespace App\DataTables\Dashboard;

use App\Enums\BlockEnum;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SummaryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('customer_name', function ($query) {
                return $query->customer ? $query->customer->name : "";
            })
            ->addColumn('remain_installments_price', function ($query) {
                return $query->remain_installments_price;
            })
            ->addColumn('about_month', function ($query) {
                return $query->installment_turn ? $query->installment_turn->pay_date : "";
            })
            ->addColumn('total_profit_for_remain_months', function ($query) {
                return $query->profit_percentage * $query->remain_installments_price;
            })
            ->addColumn('months_count', function ($query) {
                return count($query->installments);
            })
            ->addColumn('first_installment', function ($query) {
                return $query->pay_day . '-' . $query->pay_month . '-' . $query->pay_year;
            })
            ->addColumn('daman_value', function ($query) {
                return ($query->papers->count() > 0) ? $query->papers->count() . ' * ' . $query->paper_amount : '';
            })
            ->addColumn('is_late', function ($query) {
                return $query->customer ? $query->customer->is_late ? 'نعم' : '' : '';
            })
            ->rawColumns(['customer_name', 'remain_installments_price', 'about_month', 'total_profit_for_remain_months',
                'months_count', 'first_installment', 'daman_value', 'is_late'])
//            ->make(true)
//            ->footer(function ($query) {
//                // Calculate the sum of "column1"
////                $sum = $query->sum('total_profit_for_remain_months');
//
//                // Initialize a variable to store the sum
//                $sum = 0;
//
//                // Iterate through the data rows
//                foreach ($query as $row) {
//                    // Add the value of "column1" to the sum
//                    $sum += $row->total_profit_for_remain_months;
//                }
//                // Add the sum to the footer row
//                return [
//                    'customer_name' => '',
//                    'remain_installments_price' => '',
//                    'about_month' => '',
//
//                    'total_profit_for_remain_months' => "Total: $sum",
//                    'months_count' => '',
//                    'first_installment' => '',
//                    'daman_value' => '',
//                    'is_late' => '',
////                    'column3' => '',
//                ];
//            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model, Request $request)
    {
        $q = $model->newQuery();
        $q->whereIn('status', [0,1, 2]);
        return $q;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('summary-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->lengthMenu(
                [
                    [10, 25, 50, -1],
                    [trans('lang.10row'), trans('lang.25row'), trans('lang.50row'), trans('lang.allRows')]])
            ->parameters([
                'language' => [app()->getLocale() == 'en' ?: 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json'],
                'responsive' => true,
                'scrollX' => true,
                 'initComplete' => 'function (row, data, start, end, display) {
            var api = this.api();
            api.columns(".sum").every(function () {
                var sum = this
                    .data()
                    .reduce(function (a, b) {
                        return a + b;
                    }, 0);
                $(this.footer()).html("Total: "+ sum);
            });
        }',

            ]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'defaultContent' => '',
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
                'title' => '#',
                'render' => null,
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => true,
                'footer' => '',
            ],
            Column::make('transaction_number')->title('كود العميل'),
            Column::make('id')->title('رقم الفاتورة'),
            Column::make('customer_name')->title('اسم العميل')->width(250),
            Column::make('is_late')->title('متأخر'),
            Column::make('remain_installments_price')->title('اجمال المتبقي من القسط'),
            Column::make('note')->title('الملاحظات'),
            Column::make('about_month')->title('عن شهر'),
            Column::make('excuse_1')->title('السماحية 1'),
            Column::make('excuse_2')->title('السماحية 2'),
            Column::make('total_price')->title('سعر الكاش'),
            Column::make('deposit')->title('المقدم النهائي'),
            Column::make('installment_price')->title('اجمالي سعر القسط'),
            Column::make('remaining_price')->title('السعر المتبقي'),
            Column::make('monthly_installment')->title('مبلغ التقسيط'),
            Column::make('profit_percentage')->title('نسبة الربح للفاتورة'),
            Column::make('total_profit_for_remain_months')->title('اجمالي الربح للاشهر المتبقية'),
            Column::make('months_count')->title('عدد اشهر القسط'),
            Column::make('first_installment')->title('بداية اول قسط'),
            Column::make('invoice_date')->title('تاريخ الشراء'),
            Column::make('daman_value')->title('قيمة الوصل'),
            Column::make('product')->title('المباع'),

        ];
    }



    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Customer_' . date('YmdHis');
    }
}

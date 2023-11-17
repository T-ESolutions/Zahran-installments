<?php

namespace App\DataTables\Dashboard;

use App\Models\Invoice;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InvoiceExecutionDataTable extends DataTable
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
            ->addColumn('action', 'Dashboard.Invoice.parts.action')
            ->editColumn('customer_name', function ($model) {
                return $model->customer->name ?? '';
            })->editColumn('created_by', function ($model) {
                return $model->admin->name ?? '';
            })
            ->addColumn('laws_cost', function ($invoice) {
                if ($invoice->unPaidLawSuit->count() > 0) {
                    $amount = $invoice->unPaidLawSuit->sum('amount') - $invoice->unPaidLawSuit->sum('paid_amount');
                         } else {
                    $amount = 0;
                }
                return $amount;
            })
            ->editColumn('status', 'Dashboard.Invoice.parts.status')
            ->rawColumns(['action', 'status', 'laws_cost']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model)
    {
        return $model->where('status', 4)->orderBy('id', 'desc')->newQuery()->with(['customer', 'admin']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Invoice-table')
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
                'footer' => true, // Enable DataTable footer
                'drawCallback' => 'function(settings) {
                var api = this.api();
                 $(api.column(0).footer()).html(`المجموع`);

                var totalCol7 = api.column(7).data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0);
                $(api.column(7).footer()).html(totalCol7.toFixed(2)).addClass("text-info");

                 var totalCol8 = api.column(8).data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0);
                $(api.column(8).footer()).html(totalCol8.toFixed(2)).addClass("text-info");


                 var total = totalCol7  + totalCol8 ;
    $(api.column(10).footer()).html(`الاجمالي = `);
                $(api.column(11).footer()).html( total ).addClass("text-info");

            }',

            ])
            ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('رقم الفاتورة'),
            Column::make('invoice_number')->title('رقم فاتورة الشراء'),
            Column::make('transaction_number')->title(trans('lang.transaction_number')),
            Column::make('customer_name')->name('customer.name')->title(trans('lang.customer_name')),

            Column::make('total_price')->title('سعر الكاش'),
            Column::make('deposit')->title('المقدم النهائي'),
            Column::make('installment_price')->title('اجمالي سعر القسط'),
            Column::make('remain_installments_price')->title('قيمة الاقساط المتبقية'),
            Column::make('laws_cost')->title('قيمة المصاريف القضائية'),
            Column::make('status')->title(trans('lang.status'))->orderable(false),
            Column::make('created_by')->searchable(false)->title(trans('lang.created_by')),
            Column::make('action')->title(trans('lang.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Invoice_' . date('YmdHis');
    }
}

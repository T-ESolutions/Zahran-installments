<?php

namespace App\DataTables\Dashboard;

use App\Models\Invoice;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InvoiceDataTable extends DataTable
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
            })   ->editColumn('created_by', function ($model) {
                return $model->admin->name ?? '';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model)
    {
        return $model->newQuery()->with(['customer','admin']);
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
                    [trans('lang.10row'), trans('lang.25row'),trans('lang.50row'), trans('lang.allRows')] ])

            ->parameters([
                'language' => [app()->getLocale() == 'en' ?: 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json'],
                 'responsive' => true,
                 'scrollX' => true

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
            Column::make('id')->title('رقم الفاتورة'),
            Column::make('transaction_number')->title(trans('lang.transaction_number')),
            Column::make('customer_name')->name('customer.name')->title(trans('lang.customer_name')),

            Column::make('pay_day')->title(trans('lang.pay_day')),
            Column::make('total_price')->title(trans('lang.total_price')),
            Column::make('deposit')->title(trans('lang.deposit')),
            Column::make('deposit')->title(trans('lang.deposit')),
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

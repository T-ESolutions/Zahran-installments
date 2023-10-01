<?php

namespace App\DataTables\Dashboard;

use App\Models\Invoice;
use App\Models\InvoiceInstallments;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InvoiceInstallmentsDataTable extends DataTable
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
            ->addColumn('changeDate', 'Dashboard.Invoice.installmentsParts.changeDate')
            ->addColumn('postingInstallment', 'Dashboard.Invoice.installmentsParts.postingInstallment')
            ->addColumn('monthPostingInstallment', 'Dashboard.Invoice.installmentsParts.monthPostingInstallment')
            ->addColumn('history', 'Dashboard.Invoice.installmentsParts.history')
            ->rawColumns(['changeDate', 'postingInstallment','monthPostingInstallment','history']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(InvoiceInstallments $model)
    {
        $q = $model->newQuery()->where('invoice_id', $this->id)->with(['history'])->orderBy('id', 'ASC');
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
            ->setTableId('InvoiceInstallments-table')
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
            Column::make('id')->hidden(),
            Column::make('status')->title(trans('lang.status'))->orderable(false),
            Column::make('late_days')->title(trans('lang.late_days'))->orderable(false),
            Column::make('monthly_installment')->title(trans('lang.monthly_installment')),
            Column::make('paid_amount')->title(trans('lang.paid_amount')),
            Column::make('pay_date')->title(trans('lang.pay_date')),
            Column::make('changeDate')->title(trans('lang.change_date')),
            Column::make('postingInstallment')->title(trans('lang.posting_installment')),
            Column::make('monthPostingInstallment')->title(trans('lang.month_posting_installment'))->orderable(false),
            Column::make('history')->title(trans('lang.history'))->orderable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'InvoiceInstallments_' . date('YmdHis');
    }
}

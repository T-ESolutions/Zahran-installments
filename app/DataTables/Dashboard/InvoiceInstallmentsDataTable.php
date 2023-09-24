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
            ->rawColumns(['changeDate']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(InvoiceInstallments $model)
    {

         return $model->newQuery()->where('invoice_id',$this->id)->with([])->orderBy('id', 'ASC');
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

            Column::make('status')->title(trans('lang.status')),
            Column::make('monthly_installment')->title(trans('lang.monthly_installment')),
            Column::make('pay_date')->title(trans('lang.pay_date')),
             Column::make('changeDate')->title(trans('lang.change_date')),
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

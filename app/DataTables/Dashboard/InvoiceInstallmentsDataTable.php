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
            ->editColumn('status', 'Dashboard.Invoice.installmentsParts.status')
            ->rawColumns(['changeDate','status']);
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

            Column::make('id')->title('رقم القسط'),
            Column::make('pay_date')->title('يوم السداد'),
            Column::make('monthly_installment')->title(trans('lang.monthly_installment')),
            Column::make('paid_amount')->title(trans('lang.paid_amount')),
            Column::make('status')->title(trans('lang.status'))->orderable(false),
            Column::make('late_days')->title(trans('lang.late_days'))->orderable(false),
            Column::make('notes')->title(trans('lang.notes')),
            Column::make('changeDate')->title('الاجراءات'),


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

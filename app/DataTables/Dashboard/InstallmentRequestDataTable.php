<?php

namespace App\DataTables\Dashboard;

use App\Models\InstallmentRequest;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InstallmentRequestDataTable extends DataTable
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
            ->editColumn('customer_name', function ($model) {
                return $model->customer->name ?? '';
            })
            ->editColumn('customer_id_number', function ($model) {
                return $model->customer->id_number ?? '';
            })
            ->editColumn('created_at', function (InstallmentRequest $model) {
                return $model->created_at->format('Y-m-d H:i:s A');
            })
            ->editColumn('remaining_price', function (InstallmentRequest $model) {
                return $model->remaining_price;
            })
            ->addColumn('action', 'Dashboard.InstallmentRequest.parts.action')
            ->addColumn('id_received', 'Dashboard.InstallmentRequest.parts.id_received')
            ->addColumn('status', 'Dashboard.InstallmentRequest.parts.status')
            ->rawColumns(['action','id_received','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\InstallmentRequest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(InstallmentRequest $model)
    {
        return $model->newQuery()->with(['customer']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('InstallmentRequest-table')
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
            Column::make('customer_id_number')->name('customer.id_number')->title(trans('lang.customer_id_number')),
            Column::make('customer_name')->name('customer.name')->title(trans('lang.customer_name')),
            Column::make('price')->title(trans('lang.price')),
            Column::make('deposit')->title(trans('lang.deposit')),
            Column::make('remaining_price')->title(trans('lang.remaining_price'))->orderable(false)->searchable(false),
            Column::make('created_at')->title(trans('lang.created_at')),
            Column::make('id_received')->title(trans('lang.id_received'))->orderable(false),
            Column::make('status')->title(trans('lang.status'))->width(150)->orderable(false),
            Column::make('action')->title(trans('lang.action'))->orderable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'InstallmentRequest_' . date('YmdHis');
    }
}

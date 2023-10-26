<?php

namespace App\DataTables;

use App\Models\Lawsuit;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LawsuitDataTable extends DataTable
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
            ->addColumn('action', '.Lawsuit.parts.action')
            ->addColumn('customer_name', function ($model) {
                return $model->invoice->customer->name ?? '';
            })
            ->addColumn('invoice_number', function ($model) {
                return $model->invoice->invoice_number ?? '';
            })
            ->editColumn('created_by', function ($model) {
                return $model->admin->name ?? '';
            })
            ->editColumn('type', function ($model) {
                return ($model->type == 1)? 'انذار' : 'قضية';
            })
            ->rawColumns(['action','customer_name','type','invoice_number']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Lawsuit $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Lawsuit $model)
    {
        return $model->orderBy('id','desc')->newQuery()->with(['customer', 'admin']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Lawsuit-table')
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

            Column::make('id')->title('رقم القضية'),
            Column::make('title')->title('الاسم'),
            Column::make('type')->title('النوع'),
            Column::make('customer_name')->title(trans('lang.customer_name')),
            Column::make('invoice_id')->title('رقم الفاتورة'),
            Column::make('invoice_number')->title('رقم فاتورة الشراء'),
            Column::make('created_by')->searchable(false)->title(trans('lang.created_by')),
            Column::make('amount')->title(trans('lang.amount')),
            Column::make('paid_amount')->title(trans('lang.paid_amount')),
            Column::make('status')->title(trans('lang.status')),
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
        return 'Lawsuit_' . date('YmdHis');
    }
}

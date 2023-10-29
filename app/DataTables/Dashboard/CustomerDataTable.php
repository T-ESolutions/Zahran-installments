<?php

namespace App\DataTables\Dashboard;

use App\Enums\BlockEnum;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
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
            ->addColumn('action', 'Dashboard.Customer.parts.action')
            ->addColumn('activation', 'Dashboard.Customer.parts.activation')
            ->addColumn('created_by', function ($query) {
                return $query->admin->name;
            })
            ->rawColumns(['action', 'activation']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model, Request $request)
    {
        $q = $model->newQuery()->with(['admin']);

        if ($request->law) {
            $q->whereHas('invoices', function ($q){
                $q->whereHas('lawSuit');
            });
        }

        if ($request->blocked) {
            $q->where('is_blocked', BlockEnum::BLOCKED->value);
        }
        if ($request->late) {
            $q->where('is_late', BlockEnum::BLOCKED->value);
        }
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
            ->setTableId('Customer-table')
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
            Column::make('name')->title(trans('lang.name')),
            Column::make('phone')->title(trans('lang.phone')),
            Column::make('activation')->title(trans('lang.black_list'))->visible(auth()->user()->can('change-activation-customers')),
            Column::make('created_by')->title(trans('lang.created_by')),
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
        return 'Customer_' . date('YmdHis');
    }
}

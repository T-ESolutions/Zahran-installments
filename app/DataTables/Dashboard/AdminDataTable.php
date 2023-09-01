<?php

namespace App\DataTables\Dashboard;

use App\Models\Admin;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('action', 'Dashboard.admin.parts.action')
            ->addColumn('activation', 'Dashboard.admin.parts.activation')
            ->rawColumns(['action','activation','id']);
    }

    public function query(Admin $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('admin-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->lengthMenu(
                [
                    [10, 25, 50, -1],
                    [trans('lang.10row'), trans('lang.25row'),trans('lang.50row'), trans('lang.allRows')]                ])
            ->parameters([
                'language' => [ app()->getLocale()=='en' ?'' : 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json']

            ]);
    }

    protected function getColumns()
    {

        return [
            Column::make('id')->title(trans('lang.id')),
            Column::make('name')->title(trans('lang.name')),
            Column::make('email')->title(trans('lang.email')),
            Column::make('activation')->title(trans('lang.activation'))->visible(auth()->user()->can('change-activation-admins')),
            Column::make('action')->title(trans('lang.action'))->visible(auth()->user()->can('delete-admins') || auth()->user()->can('update-admins') ),
        ];
    }

    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}

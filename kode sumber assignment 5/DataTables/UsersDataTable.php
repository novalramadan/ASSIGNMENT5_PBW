<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($user) {
            return '<a href="/userView/' . $user->id . '" class="btn btn-primary">View</a>';
        })
        ->setRowId('id');
    }

//    NOVAL ABDURRAMADAN 6706223103 
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->select([
            'id',
            'fullname',
            'username',
            'address',
            'religion',
            'birthdate',
            'phoneNumber',
            DB::raw('CASE gender
                WHEN 0 THEN "Male"
                WHEN 1 THEN "Female"
                ELSE "Genderless"
                END AS gender'),
            'created_at',
            'updated_at'
        ]);

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                    Button::make('add'),
                    Button::make('excel'),
                    Button::make('csv'),
                    Button::make('pdf'),
                    Button::make('print'),
                    Button::make('reset'),
                    Button::make('reload'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
                  Column::make('id'),
                  Column::make('fullname'),
                  Column::make('address'),
                  Column::make('religion'),
                  Column::make('username'),
                  Column::make('phoneNumber'),
                  Column::make('birthdate'),
                  Column::make('gender'),
                  Column::make('created_at'),
                  Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}

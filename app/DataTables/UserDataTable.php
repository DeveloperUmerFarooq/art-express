<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('actions', function($query){
            return view('admin.user-management.actions', [
                'id' => $query->id,
                'user' => $query
            ]);
        })
        ->addColumn('user',function ($query){
            return view('admin.user-management.user-column',['user'=>$query]);
    })
        ->addColumn('created_at',function($query){
            return $query->created_at->format('d/m/Y');
        })
        ->addColumn('updated_at',function($query){
            return $query->updated_at->format('d/m/Y');
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->role('user')->with('profile')->newQuery()->orderBy('created_at', 'desc');;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->pageLength(25)
                    ->orderBy(2)
                    ->ordering(false)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('user')->searchable(true),
            Column::make('name')->visible(false),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('actions')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
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

class SearchArtistDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action',function($query) {
                return view('messages.actions.action')->with('id',$query->id);
            })
            ->addColumn('user',function ($query){
                return view('admin.user-management.user-column',['user'=>$query]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->role('artist')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('searchartist-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom(
                        "<'row'<'col-12' t>>" .
                        "<'row'<'col-sm-6 d-flex align-items-center' i><'col-sm-6 d-flex justify-content-end' p>>"
                    )
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('user'),
            Column::make('name')->visible(false),
            Column::make('email')->visible(false),
            Column::make('action')->width(25)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SearchArtist_' . date('YmdHis');
    }
}

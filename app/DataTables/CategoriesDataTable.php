<?php

namespace App\DataTables;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
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
            return view('admin.categories.actions.actions', [
                'id' => $query->id,
                'category' => $query
            ]);
        })
        ->addColumn('subCategories_count',function($query){
            return $query->subCategories()->count();
        })
        ->addColumn('sub_categories',function($query){
            return view('admin.categories.actions.view-action',[
                'id'=>$query->id
            ]);
        })
        ->addColumn('products_count',function($query){
            return $query->products->count();
        })
        ->addColumn('created_at',function($query){
            return $query->created_at->format('d/m/Y');
        })
        ->addColumn('updated_at',function($query){
            return $query->updated_at->format('d/m/Y');
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Categories $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('categories-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->ordering(false)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns=[
            Column::make('name'),
            Column::make('products_count')->addClass('text-center'),
            Column::make('subCategories_count')->addClass('text-center'),
            Column::make('sub_categories')->addClass('text-center'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
        if(auth()->user()->can('manage categories')){
            $columns[]=Column::make('actions');
        }
        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}

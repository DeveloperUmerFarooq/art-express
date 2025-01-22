<?php

namespace App\DataTables;

use App\Models\SubCategories;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubCategoriesDataTable extends DataTable
{

    protected $id;


    public function subCategories($id){
        $this->id=$id;
        return $this;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('actions', function($query){
            return view('admin.categories.actions.subactions', [
                'id' => $query->id,
                'category' => $query
            ]);
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
    public function query(SubCategories $model): QueryBuilder
    {
        return $model->where('category_id',$this->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('subcategories-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->ordering(false)
                    ->orderBy(1)
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
        return [
            Column::make('name'),
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
        return 'SubCategories_' . date('YmdHis');
    }
}

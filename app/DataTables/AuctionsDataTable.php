<?php

namespace App\DataTables;

use App\Models\Auction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AuctionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addIndexColumn()
            ->addColumn('start_date', function ($query) {
                return Carbon::parse($query->start_date)->format('d-m-Y');
            })
            ->editColumn('start_time', function ($query) {
                return Carbon::parse($query->start_time)->format('h:i A');
            })
            ->editColumn('end_time', function ($query) {
                return Carbon::parse($query->end_time)->format('h:i A');
            })
            ->editColumn('status',function($query){
                return view('auction.columns.status',compact('query'));
            })
            ->addColumn('actions',function ($query){
                return view('auction.columns.actions',compact('query'));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Auction $model): QueryBuilder
    {
        return $model->newQuery()
        ->orderByRaw("FIELD(status, 'ongoing', 'upcoming', 'ended')");
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('auctions-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->ordering(false)
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('title'),
            Column::make('description'),
            Column::make('start_date'),
            Column::make('start_time'),
            Column::make('end_time'),
            Column::make('status'),
            Column::make('actions')
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Auctions_' . date('YmdHis');
    }
}
